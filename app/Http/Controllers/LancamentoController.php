<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\{
    CentroCusto,
    Lancamento,
    Tipo,
    User
};



class LancamentoController extends Controller
{
    /**
     * Listar todos os produtos
     */
    public function index(Request $request, $search = null)
    {
        $search = $request->get('search');
        $dt_inicial = $request->get('dt_inicial')??null;
        $dt_final = $request->get('dt_final')??null;
        $tipo = $request->get('id_tipo')??null;
        $centro = $request->get('id_centro_custo')??null;

        $centros = CentroCusto::class;
        $tipos = Tipo::class;

        // dd($search);
        // where('id_user', Auth::user()->id)
        $lancamentos = Lancamento::where(function ($query) use($search,$dt_inicial,$dt_final,$tipo,$centro){
            if ($search) {
                $query->where('descricao', 'like', "%$search%");
            }
            if ($dt_inicial) {
                $query->where('vencimento','>=',$dt_inicial);
            }
            if ($dt_final) {
                $query->where('vencimento','<=',$dt_final);
            }
            if ($tipo) {
                $query->where('id_tipo','=',"$tipo");
            }
            if ($centro) {
                $query->where('id_centro_custo','=',$centro);
            }
        })->orderBy('id_lancamento', 'desc')->paginate(10);

        return view('lancamento.index')->with(compact('lancamentos','tipos','centros'));
    }

    /**
     * Direciona para o formulario de novo lancamento
     */
    public function create()
    {
        $lancamento = null;
        $centrosDeCusto = CentroCusto::class;
        // $tipos = Tipo::class;
        $tipos = Tipo::class;
        return view('lancamento.form')->with(compact('lancamento', 'centrosDeCusto', 'tipos'));
    }

    /**
     * Cadastrar um novo lancamento
     */
    public function store(Request $request)
    {
        $lancamento = new Lancamento();
        $lancamento->fill($request->all());
        //capturar o id do usuario logado
        $lancamento->id_user = Auth::user()->id;
        // subir o anexo
        if ($request->anexo) {
            $extension = $request->anexo->getClientOriginalExtension();
            $nomeAnexo = date('YmdHis') . '.' . $extension;
            $request->anexo->storeAs('anexos', $nomeAnexo);
            $lancamento->anexo = $nomeAnexo;

            // $lancamento->anexo = $request->anexo->store('anexos');
        }
        $lancamento->save();
        return redirect()->route('lancamento.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lancamento $lancamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lancamento $lancamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lancamento $lancamento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lancamento $lancamento)
    {
        //
    }
}
