<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {
        try {
            return view('home.index');
        }
        catch (\Exception $ex) {
            Alert::toast('Erro! Contate o administrador do sistema.','error');
            return redirect()->back();
        }
    }
}
