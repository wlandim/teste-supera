<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use App\Empresa;
use App\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::orderBy('nome')->paginate(10);

        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Empresa $empresa
     * @return \Illuminate\Http\Response
     */
    public function create(Empresa $empresa)
    {
        $empresa_id = $empresa->id;
        $empresa_nome_fantasia = $empresa->nome_fantasia;

        return view('usuarios.create', compact('empresa', 'empresa_id', 'empresa_nome_fantasia'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUsuarioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsuarioRequest $request)
    {
        $data = $request->validated();

        $cpf = preg_replace(['/\./', '/-/'], '', $data['cpf']);

        # Formata o CPF
        $data['cpf'] = substr($cpf, 0, 3) . '.' .
                        substr($cpf, 3, 3) . '.' .
                        substr($cpf, 6, 3) . '-' .
                        substr($cpf, -2, 2);

        $usuario = Usuario::create($data);

        return redirect()->route('usuarios.show', $usuario->id)
            ->withMessage('O usuário foi criado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        $empresa_id = $usuario->empresa->id;
        $empresa_nome_fantasia = $usuario->empresa->nome_fantasia;

        return view('usuarios.show', compact('usuario', 'empresa_id', 'empresa_nome_fantasia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        $empresa_id = $usuario->empresa->id;
        $empresa_nome_fantasia = $usuario->empresa->nome_fantasia;

        return view('usuarios.edit', compact('usuario', 'empresa_id', 'empresa_nome_fantasia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUsuarioRequest  $request
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsuarioRequest $request, Usuario $usuario)
    {
        $data = $request->validated();
        $usuario->update($data);

        return redirect()->route('usuarios.show', $usuario->id)
            ->withMessage('As alterações no usuário foram salvas.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Usuario $usuario)
    {
        $usuario->delete();

        return redirect()->route('empresas.show', $usuario->empresa->id)
            ->withMessage('O usuário foi excluído.');
    }
}
