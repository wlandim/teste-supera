@extends('layouts.app')

@section('content')
    @include('layouts.headers.empresas')
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Nova empresa</h3>
                    </div>
                    <form method="post" action="{{ route('empresas.store') }}" enctype="multipart/form-data" class="p-4">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="cnpj">CNPJ</label>
                                <div class="form-group @error('cnpj') has-danger @enderror">
                                    <input type="text" class="form-control form-control-alternative @error('cnpj') is-invalid @enderror"
                                           id="cnpj" name="cnpj" value="{{ old('cnpj') }}" placeholder="Ex: 12.345.678/0001-00" maxlength="18" autofocus>
                                    @error('cnpj')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="nome_fantasia">Nome fantasia</label>
                                <div class="form-group @error('nome_fantasia') has-danger @enderror">
                                    <input type="text" class="form-control form-control-alternative @error('nome_fantasia') is-invalid @enderror"
                                           id="nome_fantasia" name="nome_fantasia" value="{{ old('nome_fantasia') }}" placeholder="">
                                    @error('nome_fantasia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="razao_social">Razão social</label>
                                <div class="form-group @error('razao_social') has-danger @enderror">
                                    <input type="text" class="form-control form-control-alternative @error('razao_social') is-invalid @enderror"
                                           id="razao_social" name="razao_social" value="{{ old('razao_social') }}" placeholder="">
                                    @error('razao_social')
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
                                           id="email" name="email" value="{{ old('email') }}" placeholder="">
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
                                        <option value="1">Ativo</option>
                                        <option value="0">Inativo</option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group text-center">
                                    <input type="submit" class="btn btn-success" value="Salvar"/>
                                    <a href="{{ route('empresas.index') }}" class="btn btn-primary">Voltar</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
