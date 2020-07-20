<?php

namespace App\Http\Controllers;

use App\empresa;
use App\Http\Requests\StoreEmpresaRequest;
use App\Http\Requests\UpdateEmpresaRequest;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageResize;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->query('q');
        if ($q) {
            $empresas = Empresa::whereRaw("UPPER(nome_fantasia) LIKE '%" . strtoupper($q) . "%'")->orderBy('nome_fantasia')->paginate(10);
        } else {
            $empresas = Empresa::orderBy('nome_fantasia')->paginate(10);
        }

        return view('empresas.index', compact('empresas', 'q'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empresas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmpresaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmpresaRequest $request)
    {
        $data = $request->validated();

        unset($data['logomarca']);

        $cnpj = preg_replace(['/\./', '/\//', '/-/'], '', $data['cnpj']);

        # Formata o CNPJ
        $data['cnpj'] = substr($cnpj, 0, 2) . '.' .
            substr($cnpj, 2, 3) . '.' .
            substr($cnpj, 5, 3) . '/' .
            substr($cnpj, 8, 4) . '-' .
            substr($cnpj, -2, 2);

        $empresa = Empresa::create($data);

        if($request->hasFile('logomarca')) {

            $logo = $request->file('logomarca');
            $this->uploadAndResize($logo, $empresa);

        }

        if($request->hasFile('logomarca')) {

            $logo = $request->file('logomarca');
            $empresa->logomarca = $logo->store('empresas', 'public');
            $empresa->save();

        }

        return redirect()->route('empresas.show', $empresa->id)
            ->withMessage('A empresa foi criada.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show(Empresa $empresa)
    {
        $usuarios = $empresa->usuarios()->get();
        $unidades = $empresa->unidades()->get();

        return view('empresas.show', compact('empresa', 'unidades', 'usuarios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresa $empresa)
    {
        return view('empresas.edit', compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmpresaRequest  $request
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmpresaRequest $request, Empresa $empresa)
    {
        $data = $request->validated();

        unset($data['logomarca']);

        $logoAnterior = $empresa->logomarca;

        $empresa->update($data);

        if($request->hasFile('logomarca')) {

            $logo = $request->file('logomarca');
            $this->uploadAndResize($logo, $empresa);

            if (Storage::disk('public')->exists($logoAnterior)) {
                Storage::disk('public')->delete($logoAnterior);
            }

        }

        return redirect()->route('empresas.show', $empresa->id)
            ->withMessage('As alterações na empresa foram salvas.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {
        if (Storage::disk('public')->exists($empresa->logomarca)) {
            Storage::disk('public')->delete($empresa->logomarca);
        }

        foreach ($empresa->unidades as $unidade) {
            if (Storage::disk('public')->exists($unidade->logomarca)) {
                Storage::disk('public')->delete($unidade->logomarca);
            }
        }

        $empresa->delete();

        return redirect()->route('empresas.index')
            ->withMessage('A empresa foi excluída.');
    }

    private function uploadAndResize(UploadedFile $arquivo, Empresa $empresa)
    {
        $empresa->logomarca = $arquivo->store('empresas', 'public');
        $empresa->save();

        $path = storage_path() . '/app/public/' . $empresa->logomarca;
        $img = ImageResize::make($path);
        $img->resize(200, 200, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path);
    }
}
