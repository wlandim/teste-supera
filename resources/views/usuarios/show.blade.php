@extends('layouts.app')

@section('content')
    @include('layouts.headers.usuarios')
    <!-- Page content -->
    <div class="container-fluid mt--6">
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">{{ $usuario->nome }}</h3>
                    </div>
                    <form method="post" action="{{ route('usuarios.destroy', $usuario->id) }}" class="p-4" onsubmit="event.preventDefault(); confirmeExclusao(this)">
                        @csrf
                        @method('DELETE')
                        <div class="row">
                            <div class="col-md-6">
                                <label for="cpf">CPF</label>
                                <div class="form-group">
                                    <p>{{ $usuario->cpf }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="cpf">Usuário</label>
                                <div class="form-group">
                                    <p>{{ $usuario->usuario }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group text-center">
                                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-success">Editar</a>
                                    <input type="submit" class="btn btn-danger" value="Excluir"/>
                                    <a href="{{ route('empresas.show', $usuario->empresa->id) }}" class="btn btn-primary">Voltar</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            function confirmeExclusao(form) {
                if (confirm("Confirma excluir o usuário?")) {
                    form.submit();
                }
            }
        </script>
@endsection
