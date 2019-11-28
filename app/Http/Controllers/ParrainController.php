<?php

namespace App\Http\Controllers;

use App\Parrain;
use Illuminate\Http\Request;
use Redirect;
use View;

class ParrainController extends Controller
{
    public function __construct() {
        View::share([
            'breadcrumbs' => [
                ['url' => route('parrains.index'), 'name' => "Parrains"]
            ]
        ]);
    }

    public function index() {
        return view('parrains.index', [
            'breadcrumbs' => [],
            'parrains' => Parrain::all()
        ]);
    }

    public function create() {
        return view('parrains.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'firstname' => "required|string|max:255",
            'lastname' => "required|string|max:255"
        ]);

        $parrain = new Parrain();
        $parrain->firstname = $request->firstname;
        $parrain->lastname = $request->lastname;
        $parrain->save();

        return Redirect::route('parrains.index')->with([
            'alerts' => [
                ["text" => "Le parrain ".$parrain->lastname." ".$parrain->firstname." a été créé avec succès !", "type" => "success"]
            ]
        ]);
    }

    public function edit(Parrain $parrain) {
        return view('parrains.edit', [
            'parrain' => $parrain
        ]);
    }

    public function update(Request $request, Parrain $parrain) {
        $this->validate($request, [
            'firstname' => "required|string|max:255",
            'lastname' => "required|string|max:255"
        ]);

        $parrain->firstname = $request->firstname;
        $parrain->lastname = $request->lastname;
        $parrain->save();

        return Redirect::route('parrains.index')->with([
            'alerts' => [
                ["text" => "Le parrain ".$parrain->lastname." ".$parrain->firstname." a été édité avec succès !", "type" => "success"]
            ]
        ]);
    }

    public function destroy(Parrain $parrain) {
        $parrain->delete();

        return Redirect::route('parrains.index')->with([
            'alerts' => [
                ["text" => "Le parrain ".$parrain->lastname." ".$parrain->firstname." a été supprimé avec succès !", "type" => "success"]
            ]
        ]);
    }
}
