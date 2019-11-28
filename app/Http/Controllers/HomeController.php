<?php

namespace App\Http\Controllers;

use App\Filleul;
use App\Manager;
use App\Parrain;
use Illuminate\Http\Request;

class HomeController extends Controller {
    public function index() {
        return view('home', [
            'filleulsCount' => Filleul::count(),
            'managersCount' => Manager::count(),
            'parrainsCount' => Parrain::count()
        ]);
    }
}
