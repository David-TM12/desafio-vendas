<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    
    public function index(UserDataTable $userDataTable){
        return $userDataTable->render('usuario.index');
    }


    public function create(){
        return view('usuario.form');
    }


    public function store(UserRequest $request){
        
        // $data = get_object_vars($request->all());

        $usuario = UserService::store($request->all());

        if($usuario){
            alert()->success('Usuário cadastrado com sucesso');
            return back();
        }

        alert()->error('Erro ao cadastrar o usuário');
        return back()->withInput();
    }


    public function edit(User $usuario)
    {
        return view('usuario.form', compact('usuario'));
    }


    public function update(UserRequest $request, User $usuario){
        
        $usuario = UserService::update($request->all(), $usuario);

        if($usuario){
            alert()->success('Usuário atualizado com sucesso');
            return back();
        }

        alert()->error('Erro ao atualizar o usuário');
        return back()->withInput();
    }

    public function destroy(User $usuario)
    {   
        try {
            return $usuario->delete();
        } catch (\Throwable $th) {
            return response('Erro ao apagar usuário', 400);
        }
        
    }
}
