<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(DashboardService $dashboardService)
    {
        try {
            return view('home.index', $dashboardService->getData());
        }
        catch (\Exception $ex) {
            Alert::toast('Erro! Contate o administrador do sistema.','error');
            return redirect()->back();
        }
    }
}
