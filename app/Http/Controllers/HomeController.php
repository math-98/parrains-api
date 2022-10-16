<?php

namespace App\Http\Controllers;

use App\Models\Filleul;
use App\Models\Manager;
use App\Models\Parrain;

class HomeController extends Controller
{
    public function __invoke()
    {
        $filleulsCount = Filleul::count();

        return view('home', [
            'filleulsCount' => $filleulsCount,
            'managersCount' => Manager::count(),
            'parrainsCount' => Parrain::count(),
            'parrainageCount' => $filleulsCount - Filleul::getAvailable()->count(),
        ]);
    }
}
