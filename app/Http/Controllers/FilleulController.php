<?php

namespace App\Http\Controllers;

use App\Filleul;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Redirect;
use View;

class FilleulController extends Controller
{
    public function __construct()
    {
        View::share([
            'breadcrumbs' => [
                ['url' => route('filleuls.index'), 'name' => 'Filleuls'],
            ],
        ]);
    }

    public function index()
    {
        return view('filleuls.index', [
            'breadcrumbs' => [],
            'filleuls' => Filleul::all(),
        ]);
    }

    public function create()
    {
        return view('filleuls.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
        ]);

        $filleul = new Filleul();
        $filleul->firstname = $request->firstname;
        $filleul->lastname = $request->lastname;
        $filleul->save();

        return Redirect::route('filleuls.index')->with([
            'alerts' => [
                ['text' => 'Le filleul '.$filleul->lastname.' '.$filleul->firstname.' a été créé avec succès !', 'type' => 'success'],
            ],
        ]);
    }

    public function getImport()
    {
        return view('filleuls.import');
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
            $stud = new Filleul();
            $stud->lastname = $line[0];
            $stud->firstname = $line[1];
            $stud->save();
        }

        return Redirect::route('filleuls.index')->with([
            'alerts' => [
                ['text' => 'Liste importée avec succès !', 'type' => 'success'],
            ],
        ]);
    }

    public function edit(Filleul $filleul)
    {
        return view('filleuls.edit', [
            'filleul' => $filleul,
        ]);
    }

    public function update(Request $request, Filleul $filleul)
    {
        $this->validate($request, [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
        ]);

        $filleul->firstname = $request->firstname;
        $filleul->lastname = $request->lastname;
        $filleul->save();

        return Redirect::route('filleuls.index')->with([
            'alerts' => [
                ['text' => 'Le filleul '.$filleul->lastname.' '.$filleul->firstname.' a été édité avec succès !', 'type' => 'success'],
            ],
        ]);
    }

    public function destroy(Filleul $filleul)
    {
        $filleul->delete();

        return Redirect::route('filleuls.index')->with([
            'alerts' => [
                ['text' => 'Le filleul '.$filleul->lastname.' '.$filleul->firstname.' a été supprimé avec succès !', 'type' => 'success'],
            ],
        ]);
    }
}
