<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Redirect;
use View;

class ManagerController extends Controller
{
    public function __construct()
    {
        View::share([
            'breadcrumbs' => [
                ['url' => route('managers.index'), 'name' => 'Managers'],
            ],
        ]);
    }

    public function index()
    {
        return view('managers.index', [
            'breadcrumbs' => [],
            'managers' => Manager::all(),
        ]);
    }

    public function create()
    {
        return view('managers.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'name' => 'required|string|max:255',
           'email' => 'required|email|max:255|unique:managers',
           'password' => 'required|string|confirmed|max:255',
        ]);

        $manager = new Manager();
        $manager->name = $request->name;
        $manager->email = $request->email;
        $manager->password = Hash::make($request->password);
        $manager->save();

        return Redirect::route('managers.index')->with([
            'alerts' => [
                ['text' => 'Le manager '.$manager->name.' a été créé avec succès !', 'type' => 'success'],
            ],
        ]);
    }

    public function edit(Manager $manager)
    {
        return view('managers.edit', [
            'manager' => $manager,
        ]);
    }

    public function update(Request $request, Manager $manager)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('managers')->ignore($manager->id),
            ],
            'password' => 'nullable|string|confirmed|max:255',
        ]);

        $manager->name = $request->name;
        $manager->email = $request->email;

        if ($request->exists('password')) {
            $manager->password = Hash::make($request->password);
        }

        $manager->save();

        return Redirect::route('managers.index')->with([
            'alerts' => [
                ['text' => 'Le manager '.$manager->name.' a été édité avec succès !', 'type' => 'success'],
            ],
        ]);
    }

    public function destroy(Manager $manager)
    {
        $manager->delete();

        return Redirect::route('managers.index')->with([
            'alerts' => [
                ['text' => 'Le manager '.$manager->name.' a été supprimé avec succès !', 'type' => 'success'],
            ],
        ]);
    }
}
