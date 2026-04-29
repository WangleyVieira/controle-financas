<?php

namespace App\Http\Controllers;

use App\Http\Requests\LancamentoRequest;
use App\Models\Categoria;
use App\Models\Lancamento;
use App\Models\TipoCategoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class LancamentoController extends Controller
{
    public function index()
    {
        return redirect()->route('lancamento.create');
    }

    public function create()
    {
        try {

        } catch (\Exception $ex) {
            Alert::toast('Erro! Contate o administrador do sistema.', 'error');
            return redirect()->back();
        }
    }

    public function store(LancamentoRequest $request)
    {
        try {

        }
        catch (\Exception $ex) {
            Alert::toast('Erro! Contate o administrador do sistema.', 'error');
            return redirect()->back()->withInput();
        }
    }

    public function update(LancamentoRequest $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

}
