<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = User::get();

            return view('config.usuario.index', compact('users'));
        }
        catch (\Exception $ex) {
            Alert::toast('Erro! Contate o administrador do sistema.','error');
            return redirect()->back();
        }
    }

     /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        try {
            User::create($request->validated());

            Alert::toast('Usuário cadastrado com sucesso!','success');
            return redirect()->route('configuracao.usuario.index');

        }
        catch (\Exception $ex) {
            Alert::toast('Erro! Contate o administrador do sistema.','error');
            return redirect()->back();
        }
    }

     /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->update($request->validated());

            Alert::toast('Usuário atualizado com sucesso!','success');
            return redirect()->route('configuracao.usuario.index');
        }
        catch (\Exception $ex) {
            Alert::toast('Erro! Contate o administrador do sistema.','error');
            return redirect()->back();
        }
    }

     /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            Alert::toast('Usuário excluído com sucesso!','success');
            return redirect()->route('configuracao.usuario.index');

        }
        catch (\Exception $ex) {
            Alert::toast('Erro! Contate o administrador do sistema.','error');
            return redirect()->back();
        }
    }
}
