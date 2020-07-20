@extends('layouts.app')

@section('content')
    @include('layouts.headers.empresas')
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
                        <h3 class="mb-0">Lista de empresas</h3>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="nome">Nome Fantasia</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @forelse($empresas as $empresa)
                                <tr>
                                    <td>
                                        <a class="text-sm" href="{{ route('empresas.show', $empresa->id) }}">{{ $empresa->nome_fantasia }}</a>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="{{ route('empresas.show', $empresa->id) }}">Ver</a>
                                                <a class="dropdown-item" href="{{ route('empresas.edit', $empresa->id) }}">Editar</a>
                                                <a class="dropdown-item" href="{{ route('empresas.destroy', $empresa->id) }}"
                                                   onclick="event.preventDefault(); document.getElementById('empresa-{{ $empresa->id }}').submit();">Excluir</a>
                                            </div>
                                        </div>
                                        <form id="empresa-{{ $empresa->id }}" method="post" action="{{ route('empresas.destroy', $empresa->id) }}">@csrf @method('DELETE')</form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">{{ $q ? "Não foram encontradas empresas para a busca: $q" : 'Não há empresa cadastrada.' }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- Card footer -->
                    <div class="card-footer py-4">
                        {{ $empresas->links() }}
                    </div>
                </div>
            </div>
        </div>
@endsection
