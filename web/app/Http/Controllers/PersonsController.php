<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use Session;

use App\Models\Person;
use DB;
use App\Models\Group;

class PersonsController extends CrudController {

    public function __construct(Person $model) {
        $this->model = $model;
        $this->singular = 'person';
        $this->plural = 'persons';
        $this->humanName = 'Person';

    }

    public function store()
    {
        $data = Request::all();

        $obj = $this->model->create($data);

        $groups = Request::has('group_list') ? Request::input('group_list') : [];
        $this->syncGroups($obj, $groups);


        Session::flash('flash_message', $this->humanName . ' angelegt.');

        if(Request::has('submit_list')) {
            return redirect()->route($this->plural.'.index');
        }
        else if(Request::has('submit_new')) {
            return redirect()->route($this->plural.'.create');
        }
        else if(Request::has('submit_view')) {
            return redirect()->route($this->plural.'.edit', [$obj->id]);
        }
        else {
            abort(404);
            return;
        }
    }

    public function update($id)
    {
        $data = Request::all();

        $obj = $this->model->findOrFail($id);

        $obj->update($data);

        $groups = Request::has('group_list') ? Request::input('group_list') : [];
        $this->syncGroups($obj, $groups);

        Session::flash('flash_message', 'Änderungen gespeichert.');

        return redirect()->route($this->plural.'.index');
    }

    private function syncGroups($obj, $ids) {
        foreach ($ids as $id) {
            if(!$obj->groups->contains($id)) {
                $group = Group::findOrFail($id);
                $obj->groups()->attach($id, ['order' => ($group->persons->count() + 1)]);
            }
        }

        foreach ($obj->groups()->get() as $group) {
            if(!in_array($group->id, $ids)) {
                $obj->groups()->detach($group->id);
            }
        }

    }

    public function beforeDelete($obj) {
        DB::table('group_person')
            ->where('person_id', $obj->id)->delete();
    }
}
