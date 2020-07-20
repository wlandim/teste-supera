@extends('layouts.app')

@section('content')
    @include('layouts.headers.unidades')
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Editar unidade</h3>
                    </div>
                    <form method="post" action="{{ route('unidades.update', $unidade->id) }}" enctype="multipart/form-data" class="p-4">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <label for="municipio">Município</label>
                                <div class="form-group @error('municipio') has-danger @enderror">
                                    <input type="text" class="form-control form-control-alternative @error('municipio') is-invalid @enderror"
                                           id="municipio" name="municipio" value="{{ old('municipio') ?? $unidade->municipio }}" placeholder="">
                                    @error('municipio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <div class="form-group @error('email') has-danger @enderror">
                                    <input type="text"
                                           class="form-control form-control-alternative @error('email') is-invalid @enderror"
                                           id="email" name="email" value="{{ old('email') ?? $unidade->email }}" placeholder="">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="logomarca">Logomarca</label>
                                <div class="form-group @error('logomarca') has-danger @enderror">
                                    <input type="file"
                                           class="form-control form-control-alternative @error('logomarca') is-invalid @enderror"
                                           id="logomarca" name="logomarca" value="{{ old('logomarca') }}">
                                    @error('logomarca')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="status">Status</label>
                                <div class="form-group @error('status') has-danger @enderror">
                                    <select class="form-control form-control-alternative @error('status') is-invalid @enderror"
                                            id="status" name="status" value="{{ old('status') }}">
                                        <option value="1" @if($unidade->status) selected @endif>Ativo</option>
                                        <option value="0" @if(!$unidade->status) selected @endif>Inativo</option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="tipo">Tipo</label>
                            <div class="form-group @error('tipo') has-danger @enderror">
                                <select class="form-control form-control-alternative @error('tipo') is-invalid @enderror"
                                        id="tipo" name="tipo" value="{{ old('tipo') }}">
                                    <option value=""></option>
                                    @foreach($tipos as $tipo)
                                        <option value="{{ $tipo->id }}" @if($unidade->tipo == $tipo->id) selected @endif>{{ $tipo->tipo }}</option>
                                    @endforeach
                                </select>
                                @error('tipo')
                                <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group text-center">
                                    <input type="submit" class="btn btn-success" value="Salvar"/>
                                    <a href="{{ route('unidades.show', $unidade->id) }}" class="btn btn-primary">Voltar</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
