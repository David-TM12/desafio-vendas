<?php

namespace App\Http\Controllers;

use App\DataTables\VendaDataTable;
use App\Models\Venda;
use App\Services\VendaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VendaDataTable $vendaDataTable)
    {
        return $vendaDataTable->render('venda.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('venda.form', [
            'formasPagamento' => Venda::FORMAS_PAGAMENTO
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $venda = VendaService::store($request);

        if($venda){
            alert()->success('Venda finalizada com sucesso');
            return response('', 201);
        }

        return response('Erro ao salvar a venda', 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function show(Venda $venda)
    {
        try {
            return view('venda.details', compact('venda'));
        } catch (\Throwable $th) {
            flash('Ops! Ocorreu um erro ao exibir a venda')->error();
            return back();
        }
    }

    public function graficoQtdCompras(){
        
        $dados = VendaService::graficoQtdCompras();

        return view('grafico.grafico-pi')->with(compact('dados'));
        
       
    }

}
