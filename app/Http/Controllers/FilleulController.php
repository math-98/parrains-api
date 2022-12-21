<?php

namespace App\Http\Controllers;

use App\Models\Filleul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class FilleulController extends Controller
{
    public function index()
    {
        return Filleul::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
        ]);

        return Filleul::create($data);
    }

    public function update(Request $request, Filleul $filleul)
    {
        $data = $request->validate([
            'firstname' => 'sometimes|string|max:255',
            'lastname' => 'sometimes|string|max:255',
            'absent' => 'sometimes|boolean',
            'parrain_id' => 'nullable|numeric|exists:parrains,id',
        ]);

        $filleul->update($data);

        return $filleul;
    }

    public function destroy(Filleul $filleul)
    {
        $filleul->delete();

        return Response::json(null, 204);
    }
}
