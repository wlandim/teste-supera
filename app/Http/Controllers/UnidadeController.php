<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\Http\Requests\StoreUnidadeRequest;
use App\Http\Requests\UpdateUnidadeRequest;
use App\Unidade;
use App\UnidadeTipo;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageResize;

class UnidadeController extends Controller
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
     * @param App\Empresa $empresa
     * @return \Illuminate\Http\Response
     */
    public function create(Empresa $empresa, UnidadeTipo $tipos)
    {
        $empresa_id = $empresa->id;
        $empresa_nome_fantasia = $empresa->nome_fantasia;

        $tipos = $tipos->getTipos();

        return view('unidades.create', compact('empresa', 'empresa_id', 'empresa_nome_fantasia', 'tipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUnidadeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUnidadeRequest $request)
    {
        $data = $request->validated();
        $unidade = Unidade::create($data);

        if($request->hasFile('logomarca')) {

            $logo = $request->file('logomarca');
            $this->uploadAndResize($logo, $unidade);

        }

        return redirect()->route('unidades.show', $unidade->id)
            ->withMessage('A unidade foi criada.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unidade  $unidade
     * @return \Illuminate\Http\Response
     */
    public function show(Unidade $unidade, UnidadeTipo $tipos)
    {
        $empresa_id = $unidade->empresa->id;
        $empresa_nome_fantasia = $unidade->empresa->nome_fantasia;

        $atestados = $unidade->atestados()->get();
        $tipo = $tipos->getTipo($unidade->tipo);

        return view('unidades.show', compact('unidade', 'tipo', 'atestados', 'empresa_id', 'empresa_nome_fantasia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unidade  $unidade
     * @return \Illuminate\Http\Response
     */
    public function edit(Unidade $unidade, UnidadeTipo $tipos)
    {
        $empresa_id = $unidade->empresa->id;
        $empresa_nome_fantasia = $unidade->empresa->nome_fantasia;

        $tipos = $tipos->getTipos();

        return view('unidades.edit', compact('unidade', 'empresa_id', 'empresa_nome_fantasia', 'tipos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUnidadeRequest  $request
     * @param  \App\Unidade  $unidade
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUnidadeRequest $request, Unidade $unidade)
    {
        $data = $request->validated();

        unset($data['logomarca']);

        $logoAnterior = $unidade->logomarca;

        $unidade->update($data);

        if($request->hasFile('logomarca')) {

            $logo = $request->file('logomarca');
            $this->uploadAndResize($logo, $unidade);

            if (Storage::disk('public')->exists($logoAnterior)) {
                Storage::disk('public')->delete($logoAnterior);
            }

        }

        return redirect()->route('unidades.show', $unidade->id)
            ->withMessage('As alterações na unidade foram salvas.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  \App\Unidade  $unidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Unidade $unidade)
    {
        if (Storage::disk('public')->exists($unidade->logomarca)) {
            Storage::disk('public')->delete($unidade->logomarca);
        }

        $unidade->delete();

        return redirect()->route('empresas.show', $unidade->empresa->id)
            ->withMessage('A unidade foi excluída.');

    }

    private function uploadAndResize(UploadedFile $arquivo, Unidade $unidade)
    {
        $unidade->logomarca = $arquivo->store('unidades', 'public');
        $unidade->save();

        $path = storage_path() . '/app/public/' . $unidade->logomarca;
        $img = ImageResize::make($path);
        $img->resize(200, 200, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path);
    }
}
