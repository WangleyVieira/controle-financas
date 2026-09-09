<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
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
