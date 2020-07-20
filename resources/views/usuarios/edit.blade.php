@extends('layouts.app')

@section('content')
  @include('layouts.headers.usuarios')
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Editar usuário</h3>
            </div>
            <form method="post" action="{{ route('usuarios.update', $usuario->id) }}" class="p-4">
              @csrf
              @method('PUT')
              <div class="row">
                <div class="col-md-6">
                  <label for="cpf">CPF</label>
                  <div class="form-group">
                    <p>{{ $usuario->cpf }}</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="usuario">Usuário</label>
                  <div class="form-group @error('usuario') has-danger @enderror">
                    <input type="text" class="form-control form-control-alternative @error('usuario') is-invalid @enderror"
                         id="usuario" name="usuario" value="{{ old('usuario') ?? $usuario->usuario }}" placeholder="" autofocus>
                    @error('usuario')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="nome">Nome</label>
                  <div class="form-group @error('nome') has-danger @enderror">
                    <input type="text" class="form-control form-control-alternative @error('nome') is-invalid @enderror"
                      id="nome" name="nome" value="{{ old('nome') ?? $usuario->nome }}" placeholder="">
                      @error('nome')
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
                      <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-primary">Voltar</a>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
  @endsection
