<?php

namespace App\Http\Controllers;

use App;
use App\Filleul;
use App\Parrain;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Redirect;
use Response;
use View;

class ParrainageController extends Controller
{
    public function __construct() {
        View::share([
            'breadcrumbs' => [
                ['url' => route('parrainages.index'), 'name' => "Parrainages"]
            ]
        ]);
    }

    public function index() {
        return view("parrainages.index", [
            "breadcrumbs" => [],
            "parrainages" => Filleul::getParrainages()->get(),
            "absents" => Filleul::whereAbsent(1)->get()
        ]);
    }

    public function attribution() {
        return view('parrainages.attribution');
    }

    private function getStats() {
        return [
            'filleulCount' => Filleul::getAvailable()->count(),
            'filleulTotal' => Filleul::whereAbsent(0)->count(),
            'parrainCount' => Parrain::getAvailable()->count(),
            'parrainTotal' => Parrain::whereAbsent(0)->count()
        ];
    }

    public function api(Request $request) {
        $action = $this->validate($request, [
            'action' => [
                'required',
                Rule::in(['GETDUO','FILLEULABS','PARRAINABS','DUOVALID'])
            ]
        ])['action'];

        switch ($action) {
            case 'GETDUO':
                return Response::json(array_merge([
                    'filleul' => Filleul::getAvailable()->first(),
                    'parrain' => Parrain::getAvailable()->first()
                ], $this->getStats()));
                break;

            case 'FILLEULABS':
                $id = $this->validate($request, [
                    'data' => 'required|numeric|exists:filleuls,id'
                ])['data'];
                $student = Filleul::find($id);
                $student->absent = 1;
                $student->save();

                return Response::json(array_merge([
                    'filleul' => Filleul::getAvailable()->first(),
                ], $this->getStats()));
                break;

            case 'PARRAINABS':
                $id = $this->validate($request, [
                    'data' => 'required|numeric|exists:parrains,id'
                ])['data'];
                $student = Parrain::find($id);
                $student->absent = 1;
                $student->save();

                return Response::json(array_merge([
                    'parrain' => Parrain::getAvailable()->first()
                ], $this->getStats()));
                break;

            case 'DUOVALID':
                $duo = $this->validate($request, [
                    'data.filleul' => 'required|numeric|exists:filleuls,id',
                    'data.parrain' => 'required|numeric|exists:parrains,id'
                ])['data'];

                $filleul = Filleul::find($duo['filleul']);
                $filleul->parrain_id = $duo['parrain'];
                $filleul->save();
                break;
        }

        return null;
    }

    public function pdf() {
        /** @var PDF $pdf */
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('parrainages.pdf', [
            'parrainages' => Filleul::getParrainages()->get(),
            'absents' => Filleul::whereAbsent(1)->get()
        ]);
        return $pdf->stream('iut_parrains_'.Carbon::now()->format('YmdHi').'.pdf');
    }

    public function assign(Filleul $filleul) {
        return view('parrainages.assign', [
            'filleul' => $filleul,
            'parrains' => Parrain::all()
        ]);
    }

    public function update(Request $request, Filleul $filleul) {
        $this->validate($request, [
            'parrain' => 'required|numeric|exists:parrains,id'
        ]);

        $parrain = Parrain::find($request->parrain);

        $filleul->parrain_id = $parrain->id;
        $filleul->absent = 0;
        $filleul->save();

        return Redirect::route('parrainages.index')->with([
            'alerts' => [
                ["text" => "Le filleul ".$filleul->lastname." ".$filleul->firstname." a été associé au parrain ".$parrain->lastname." ".$parrain->firstname." avec succès !", "type" => "success"]
            ]
        ]);
    }
}
