<?php

namespace App\Http\Controllers;

use App\Filleul;
use App\Manager;
use Illuminate\Http\Request;

class HomeController extends Controller {
    public function index() {
        return view('home', [
            'filleulsCount' => Filleul::count(),
            'managersCount' => Manager::count()
        ]);
    }
}
