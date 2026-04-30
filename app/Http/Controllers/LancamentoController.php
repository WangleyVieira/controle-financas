<?php

namespace App\Http\Controllers;

use App\Http\Requests\LancamentoRequest;
use App\Models\Categoria;
use App\Models\Lancamento;
use App\Models\Responsavel;
use App\Models\TipoCategoria;
use RealRashid\SweetAlert\Facades\Alert;

class LancamentoController extends Controller
{
    public function index()
    {
        try {
            $lancamentos = Lancamento::get();

            return view('lancamento.index', compact('lancamentos'));

        } catch (\Exception $ex) {
            Alert::toast('Erro! Contate o administrador do sistema.', 'error');
            return redirect()->back();
        }
    }

    public function create()
    {
        try {
            $categorias = Categoria::get();
            $tipoCategorias = TipoCategoria::get();
            $responsaveis = Responsavel::get();

            return view('lancamento.create', compact('categorias', 'tipoCategorias', 'responsaveis'));

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
