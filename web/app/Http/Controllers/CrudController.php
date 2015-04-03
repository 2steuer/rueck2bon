<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Request;
use Session;

abstract class CrudController extends Controller {

    protected $model = null;
    protected $singular = 'generic';
    protected $plural = 'generics';
    protected $humanName = 'Generic';

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$models = $this->model->orderBy('name', 'asc')->get();

        return view($this->plural.'.index', [$this->plural => $models]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view($this->plural.'.new');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Request::all();

        $obj = $this->model->create($data);

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

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$obj = $this->model->findOrFail($id);

        return view($this->plural.'.show', [$this->singular => $obj]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return view($this->plural.'.edit', [$this->singular => $this->model->findOrFail($id)]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$data = Request::all();

        $obj = $this->model->findOrFail($id);

        $obj->update($data);

        Session::flash('flash_message', 'Änderungen gespeichert.');

        return redirect()->route($this->plural.'.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$obj = $this->model->findOrFail($id);
        $name = $obj->name;

        $this->beforeDelete($obj);

        $obj->delete();

        Session::flash('flash_message', $this->humanName." $name gelöscht.");

        return redirect()->route($this->plural.'.index');
	}

    public function delete($id) {
        return view($this->plural.'.delete', [$this->singular => $this->model->findOrFail($id)]);
    }

    protected function beforeDelete($obj) {

    }

}
