<?php

namespace App\Http\Controllers;

use App\Filleul;
use App\Manager;
use App\Parrain;

class HomeController extends Controller
{
    public function index()
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
