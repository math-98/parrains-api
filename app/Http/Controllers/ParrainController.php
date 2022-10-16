<?php

namespace App\Http\Controllers;

use App\Models\Parrain;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Redirect;
use View;

class ParrainController extends Controller
{
    public function __construct()
    {
        View::share([
            'breadcrumbs' => [
                ['url' => route('parrains.index'), 'name' => 'Parrains'],
            ],
        ]);
    }

    public function index()
    {
        return view('parrains.index', [
            'breadcrumbs' => [],
            'parrains' => Parrain::all(),
        ]);
    }

    public function create()
    {
        return view('parrains.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
        ]);

        $parrain = new Parrain();
        $parrain->firstname = $request->firstname;
        $parrain->lastname = $request->lastname;
        $parrain->save();

        return Redirect::route('parrains.index')->with([
            'alerts' => [
                ['text' => 'Le parrain '.$parrain->lastname.' '.$parrain->firstname.' a été créé avec succès !', 'type' => 'success'],
            ],
        ]);
    }

    public function getImport()
    {
        return view('parrains.import');
    }

    public function postImport(Request $request)
    {
        $separators = [
            'comma' => ',',
            'semicolon' => ';',
            'colon' => ':',
            'tab' => "\t",
            'space' => ' ',
        ];

        $delimiters = [
            'double' => '"',
            'simple' => "'",
        ];

        $this->validate($request, [
            'separator' => [
                'required',
                'string',
                Rule::in(array_keys($separators)),
            ],
            'delimiter' => [
                'required',
                'string',
                Rule::in(array_keys($delimiters)),
            ],
            'file' => 'required|mimetypes:text/csv,text/plain',
        ]);

        $file = trim(file_get_contents($request->file('file')->getRealPath()));
        foreach (explode("\n", $file) as $line) {
            $line = str_getcsv($line, $separators[$request->separator], $delimiters[$request->delimiter]);
            $stud = new Parrain();
            $stud->lastname = $line[0];
            $stud->firstname = $line[1];
            $stud->save();
        }

        return Redirect::route('parrains.index')->with([
            'alerts' => [
                ['text' => 'Liste importée avec succès !', 'type' => 'success'],
            ],
        ]);
    }

    public function edit(Parrain $parrain)
    {
        return view('parrains.edit', [
            'parrain' => $parrain,
        ]);
    }

    public function update(Request $request, Parrain $parrain)
    {
        $this->validate($request, [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
        ]);

        $parrain->firstname = $request->firstname;
        $parrain->lastname = $request->lastname;
        $parrain->save();

        return Redirect::route('parrains.index')->with([
            'alerts' => [
                ['text' => 'Le parrain '.$parrain->lastname.' '.$parrain->firstname.' a été édité avec succès !', 'type' => 'success'],
            ],
        ]);
    }

    public function destroy(Parrain $parrain)
    {
        $parrain->delete();

        return Redirect::route('parrains.index')->with([
            'alerts' => [
                ['text' => 'Le parrain '.$parrain->lastname.' '.$parrain->firstname.' a été supprimé avec succès !', 'type' => 'success'],
            ],
        ]);
    }
}
