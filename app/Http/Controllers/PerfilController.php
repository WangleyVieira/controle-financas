<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerfilRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PerfilController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();

        return view('perfil.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * @param  \App\Http\Requests\PerfilRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PerfilRequest $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->update($request->validated());

            Alert::toast('Perfil atualizado com sucesso.', 'success');
            return redirect()->route('perfil.edit');

        } catch (\Exception $ex) {
            return $ex->getMessage();
            // Alert::toast('Erro ao atualizar o perfil.', 'error');
            // return redirect()->back();
        }
    }
}
