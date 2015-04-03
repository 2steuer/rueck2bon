<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\User;
use Hash;
use Request;
use Session;
use \App\Models\Trigger;
use Auth;

class UsersController extends CrudController {

	public function __construct(User $model) {
        $this->model = $model;
        $this->singular = 'user';
        $this->plural = 'users';
        $this->humanName = 'Benutzer';
    }

    public function create() {
        return view('users.new', ['triggers' => Trigger::all()->lists('name', 'id')]);
    }

    public function store() {
        $pwd = Hash::make(Request::input('password_u'));

        $data = Request::only(['name', 'email', 'admin', 'editusers']);
        $data['password'] = $pwd;

        if(!Request::has('admin'))
            $data['admin'] = false;

        if(!Request::has('editusers'))
            $data['editusers'] = false;

        $obj = User::create($data);
        $obj->allowedTriggers()->sync((Request::has('trigger_list') ? Request::input('trigger_list') : []));

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

    public function edit($id) {
        $user = User::findOrFail($id);
        $triggers = Trigger::all()->lists('name', 'id');

        return view('users.edit', ['user' => $user, 'triggers' => $triggers]);
    }

    public function update($id) {
        $data = Request::only(['name', 'email', 'admin', 'editusers']);

        if(Request::has('password_u')) {
            $data['password'] = Hash::make(Request::input('password_u'));
        }

        if(!Request::has('admin'))
            $data['admin'] = false;

        if(!Request::has('editusers'))
            $data['editusers'] = false;

        $obj = User::findOrFail($id);
        $obj->update($data);
        $obj->allowedTriggers()->sync((Request::has('trigger_list') ? Request::input('trigger_list') : []));

        Session::flash('flash_message', 'Änderungen gespeichert.');

        return redirect()->route($this->plural.'.index');
    }

    /*
     * Login functionality
     */

    public function loginForm() {
        return view('users.login');
    }

    public function login(\Illuminate\Http\Request $request) {
        $this->validate($request, ['email' => 'required|email', 'password' => 'required']);

        $cred = Request::only('email', 'password');
        $remember = Request::has('remember');

        if(Auth::attempt($cred, $remember)) {
            Session::flash('flash_message', 'Login erfolgreich.');

            return redirect()->route('alarm.index');
        }
        else {
            return redirect()->route('users.loginform')->withInput(Request::only(['email', 'remember']))->withErrors(['email' => 'Login fehlgeschlagen.']);
        }
    }

    public function logout() {
        Auth::logout();

        return redirect()->route('users.loginform');
    }
}
