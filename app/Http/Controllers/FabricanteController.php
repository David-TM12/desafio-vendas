<?php

namespace App\Http\Controllers;
use App\Http\Requests\FabricanteRequest;
use App\Models\Fabricante;
use Illuminate\Http\Request;
use App\Services\FabricanteService;
use RealRashid\SweetAlert\Facades\Alert;
use App\DataTables\FabricanteDataTable;
use Throwable;

class FabricanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FabricanteDataTable $fabricanteDataTable)
    {
        return $fabricanteDataTable->render('fabricante.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fabricante.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FabricanteRequest $request)
    {
        $fabricante = FabricanteService::store($request->all());
        
        if($fabricante){
            //Alert()->success($fabricante->nome,'Cadastrado com sucesso');
            toast($request->nome.' Cadastrado com sucesso','success');
            // flash($request->nome.' Cadastrado com sucesso')->success();

            return back();
        }

        Alert('Erro ao salvar fabricante', 'Error');
        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fabricante  $fabricante
     * @return \Illuminate\Http\Response
     */
    public function show(Fabricante $fabricante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fabricante  $fabricante
     * @return \Illuminate\Http\Response
     */
    public function edit(Fabricante $fabricante)
    {
        return view('fabricante.form', compact('fabricante'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fabricante  $fabricante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fabricante $fabricante)
    {
        $fabricante = FabricanteService::update($request->all(), $fabricante);

        if($fabricante){
            Alert()->success($request->nome,'Atualizado com sucesso');
            // toast($request->nome.' Atualizado com sucesso','success');
            return back();
        }

        alert()->error('Erro ao atualizar o fabricante');
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fabricante  $fabricante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fabricante $fabricante)
    {
        try{
            $fabricante->delete();
        }catch(Throwable $th){
            return response('erro ao apagar', 400);
        }
    }
}
