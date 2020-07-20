@extends('layouts.app')

@section('content')
    @include('layouts.headers.atestados')
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
                        <h3 class="mb-0">{{ $atestado->created_at->format('d/m/Y H:i') }}</h3>
                    </div>
                    <form method="post" action="{{ route('atestados.destroy', $atestado->id) }}" class="p-4" onsubmit="event.preventDefault(); confirmeExclusao(this)">
                        @csrf
                        @method('DELETE')
                        <div class="row">
                            <div class="col-md-6">
                                <label for="paciente">Paciente</label>
                                <div class="form-group">
                                    <p>{{ $atestado->paciente->nome }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="acompanhante">Acompanhante</label>
                                <div class="form-group">
                                    <p>{{ $atestado->acompanhante->nome }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="obito">Óbito</label>
                                <div class="form-group">
                                    <p>{{ $atestado->obito->nome }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group text-center">
                                    <a href="{{ route('atestados.edit', $atestado->id) }}" class="btn btn-success">Editar</a>
                                    <input type="submit" class="btn btn-danger" value="Excluir"/>
                                    <a href="{{ route('unidades.show', $atestado->unidade->id) }}" class="btn btn-primary">Voltar</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmeExclusao(form) {
            if (confirm("Confirma excluir o atestado?")) {
                form.submit();
            }
        }
    </script>
@endsection
