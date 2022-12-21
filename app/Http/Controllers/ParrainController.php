<?php

namespace App\Http\Controllers;

use App\Models\Parrain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ParrainController extends Controller
{
    public function index()
    {
        return Parrain::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
        ]);

        return Parrain::create($data);
    }

    public function update(Request $request, Parrain $parrain)
    {
        $data = $request->validate([
            'firstname' => 'sometimes|string|max:255',
            'lastname' => 'sometimes|string|max:255',
            'absent' => 'sometimes|boolean',
        ]);

        $parrain->update($data);

        return $parrain;
    }

    public function destroy(Parrain $parrain)
    {
        $parrain->delete();

        return Response::json(null, 204);
    }
}
