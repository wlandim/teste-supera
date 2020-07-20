<?php

namespace App\Http\Controllers;

use App\Acompanhante;
use App\Atestado;
use App\Http\Requests\StoreAtestadoRequest;
use App\Http\Requests\UpdateAtestadoRequest;
use App\Obito;
use App\Paciente;
use App\Unidade;
use Illuminate\Http\Request;

class AtestadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
      @param App\Unidade $unidade
     * @return \Illuminate\Http\Response
     */
    public function create(Unidade $unidade)
    {
        $unidade_id = $unidade->id;
        $unidade_municipio = $unidade->municipio;

        $pacientes = Paciente::all()->sortBy('nome');
        $acompanhantes = Acompanhante::all()->sortBy('nome');
        $obitos = Obito::all()->sortBy('nome');

        return view('atestados.create',
            compact('unidade', 'unidade_id', 'unidade_municipio',
                'pacientes', 'acompanhantes', 'obitos')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAtestadoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAtestadoRequest $request)
    {
        $data = $request->validated();
        $atestado = Atestado::create($data);

        $request->session()->flash('message', 'O atestado foi criado.');

        return redirect()->route('atestados.show', $atestado->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Atestado  $atestado
     * @return \Illuminate\Http\Response
     */
    public function show(Atestado $atestado)
    {
        $unidade_id = $atestado->unidade->id;
        $unidade_municipio = $atestado->unidade->municipio;

        return view('atestados.show', compact('atestado', 'unidade_id', 'unidade_municipio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Atestado  $atestado
     * @return \Illuminate\Http\Response
     */
    public function edit(Atestado $atestado)
    {
        $unidade_id = $atestado->unidade->id;
        $unidade_municipio = $atestado->unidade->municipio;

        $pacientes = Paciente::all()->sortBy('nome');
        $acompanhantes = Acompanhante::all()->sortBy('nome');
        $obitos = Obito::all()->sortBy('nome');

        return view('atestados.edit', compact('atestado', 'unidade_id', 'unidade_municipio',
            'pacientes', 'acompanhantes', 'obitos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAtestadoRequest  $request
     * @param  \App\Atestado  $atestado
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAtestadoRequest $request, Atestado $atestado)
    {
        $data = $request->validated();

        $atestado->update($data);

        return redirect()->route('atestados.show', $atestado->id)
            ->withMessage('As alterações no atestado foram salvas.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Atestado  $atestado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Atestado $atestado)
    {

        $atestado->delete();

        return redirect()->route('unidades.show', $atestado->unidade->id)
            ->withMessage('O atestado foi excluído.');

    }
}
