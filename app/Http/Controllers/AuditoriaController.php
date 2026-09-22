<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AuditoriaController extends Controller
{
    public function index(Request $request)
    {
        try {
            $audits = Audit::with('usuario')
                ->when($request->filled('action'), fn ($query) => $query->where('action', $request->string('action')))
                ->when($request->filled('auditable_type'), fn ($query) => $query->where('auditable_type', $request->string('auditable_type')))
                ->latest()
                ->get();

            return view('auditoria.index', [
                'audits' => $audits,
                'action' => $request->input('action'),
                'auditableType' => $request->input('auditable_type'),
            ]);
        } catch (\Exception $ex) {
            Alert::toast('Erro ao carregar a auditoria.', 'error');
            return redirect()->back();
        }
    }
}
