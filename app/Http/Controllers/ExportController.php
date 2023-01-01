<?php

namespace App\Http\Controllers;

use App\Models\Filleul;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class ExportController extends Controller
{
    public function pdf()
    {
        /** @var PDF $pdf */
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('exports.pdf', [
            'parrainages' => Filleul::getParrainages()->get(),
            'absents' => Filleul::whereAbsent(1)->get(),
        ]);

        return $pdf->stream('iut_parrains_'.Carbon::now()->format('YmdHi').'.pdf');
    }
}
