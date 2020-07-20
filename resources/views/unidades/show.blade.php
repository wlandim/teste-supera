@extends('layouts.app')

@section('content')
    @include('layouts.headers.unidades')
    @if($unidade->logomarca)
        <div class="row mt--7 mb-5">
            <div class="col-12 mb-5 text-center">
                <img src="{{ asset('/storage') . '/' . $unidade->logomarca }}" width="200" height="200" class="rounded-circle">
            </div>
        </div>
    @endif
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
                        <h3 class="mb-0">{{ $unidade->municipio }}</h3>
                        <br>
                        <span class="badge badge-pill badge-lg badge-{{ $unidade->status ? 'success' : 'danger' }}">Unidade {{ $unidade->status ? 'Ativa' : 'Inativa' }}</span>
                    </div>
                    <form method="post" action="{{ route('unidades.destroy', $unidade->id) }}" class="p-4" onsubmit="event.preventDefault(); confirmeExclusao(this)">
                        @csrf
                        @method('DELETE')
                        <div class="row">
                            <div class="col-md-6">
                                <label for="municipio">Município</label>
                                <div class="form-group">
                                    <p>{{ $unidade->municipio }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <div class="form-group">
                                    <p>{{ $unidade->email }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="tipo">Tipo</label>
                                <div class="form-group">
                                    <p>{{ $tipo }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group text-center">
                                    <a href="{{ route('unidades.edit', $unidade->id) }}" class="btn btn-success">Editar</a>
                                    <input type="submit" class="btn btn-danger" value="Excluir"/>
                                    <a href="{{ route('empresas.show', $unidade->empresa->id) }}" class="btn btn-primary">Voltar</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card my-5">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Atestados</h3>
                    </div>
                    <div class="form-group text-center">
                        <a href="{{ route('atestados.create', $unidade->id) }}" class="btn btn-primary">Novo atestado</a>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="data">Data</th>
                                <th scope="col" class="sort" data-sort="paciente">Paciente</th>
                                <th scope="col" class="sort" data-sort="acompanhante">Acompanhante</th>
                                <th scope="col" class="sort" data-sort="obito">Óbito</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @forelse($atestados as $atestado)
                                <tr>
                                    <td>
                                        <a href="{{ route('atestados.show', $atestado->id) }}">
                                            {{ $atestado->created_at->format('d/m/Y H:i') }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $atestado->paciente->nome }}
                                    </td>
                                    <td>
                                        {{ $atestado->acompanhante->nome }}
                                    </td>
                                    <td>
                                        {{ $atestado->obito->nome }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">
                                        <p>Não há atestado cadastrado.</p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmeExclusao(form) {
            if (confirm("Confirma excluir a unidade?")) {
                form.submit();
            }
        }
    </script>
@endsection
