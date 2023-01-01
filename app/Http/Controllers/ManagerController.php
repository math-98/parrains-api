<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ManagerController extends Controller
{
    public function index()
    {
        return Manager::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
           'name' => 'required|string|max:255',
           'email' => 'required|email|max:255|unique:managers',
           'password' => Password::required(),
        ]);

        return Manager::create($data);
    }

    public function update(Request $request, Manager $manager)
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => [
                'sometimes',
                'email',
                'max:255',
                Rule::unique('managers')->ignore($manager->id),
            ],
            'password' => Password::sometimes(),
        ]);

        $manager->update($data);

        return $manager;
    }

    public function destroy(Manager $manager)
    {
        if ($manager->id == Auth::id()) {
            abort(403, 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $manager->delete();

        return Response::json(null, 204);
    }
}
