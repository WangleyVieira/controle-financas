<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntradaSalarioRequest;
use App\Models\EntradaSalario;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class EntradaSalarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $entradasSalarios = EntradaSalario::orderBy('competencia')->get();

            return view('salario.index', compact('entradasSalarios'));
        } catch (\Exception $ex) {
            Alert::toast('Erro ao carregar os salários.', 'error');
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('salario.form');
        } catch (\Exception $ex) {
            Alert::toast('Erro ao carregar o formulário.', 'error');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EntradaSalarioRequest $request)
    {
        try {
            EntradaSalario::create($request->validated() + [
                'cadastrado_por_usuario' => Auth::user()->id,
            ]);

            Alert::toast('Salário cadastrado com sucesso!', 'success');
            return redirect()->route('entrada_salario.index');
        } catch (\Exception $ex) {
            Alert::toast('Erro ao cadastrar o salário.', 'error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            return view('salario.form', [
                'entradaSalario' => EntradaSalario::findOrFail($id),
            ]);
        } catch (\Exception $ex) {
            Alert::toast('Salário não encontrado.', 'error');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EntradaSalarioRequest $request, $id)
    {
        try {
            EntradaSalario::findOrFail($id)->update($request->validated());

            Alert::toast('Salário atualizado com sucesso!', 'success');
            return redirect()->route('entrada_salario.index');
        } catch (\Exception $ex) {
            Alert::toast('Erro ao atualizar o salário.', 'error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            EntradaSalario::findOrFail($id)->delete();

            Alert::toast('Salário excluído com sucesso!', 'success');
            return redirect()->route('entrada_salario.index');
        } catch (\Exception $ex) {
            Alert::toast('Erro ao excluir o salário.', 'error');
            return redirect()->back();
        }
    }
}
