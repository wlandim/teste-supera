@extends('layouts.app')

@section('content')
    @include('layouts.headers.empresas')
    @if($empresa->logomarca)
        <div class="row mt--7 mb-5">
            <div class="col-12 mb-5 text-center">
                <img src="{{ asset('/storage') . '/' . $empresa->logomarca }}" width="200" height="200" class="rounded-circle">
            </div>
        </div>
    @endif
    <!-- Page content -->
    <div class="container-fluid mt--6 mb-9">
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
                        <h3 class="mb-0">{{ $empresa->nome_fantasia }}</h3>
                        <br>
                        <span class="badge badge-pill badge-lg badge-{{ $empresa->status ? 'success' : 'danger' }}">empresa {{ $empresa->status ? 'Ativa' : 'Inativa' }}</span>
                    </div>
                    <form method="post" action="{{ route('empresas.destroy', $empresa->id) }}" class="p-4" onsubmit="event.preventDefault(); confirmeExclusao(this)">
                        @csrf
                        @method('DELETE')
                        <div class="row">
                            <div class="col-md-6">
                                <label for="cnpj">CNPJ</label>
                                <div class="form-group">
                                    <p>{{ $empresa->cnpj }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="nome_fantasia">Nome fantasia</label>
                                <div class="form-group">
                                    <p>{{ $empresa->nome_fantasia }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="razao_social">Razão social</label>
                                <div class="form-group">
                                    <p>{{ $empresa->razao_social }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <div class="form-group">
                                    <p>{{ $empresa->email }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center mt-4">
                            <a href="{{ route('empresas.edit', $empresa->id) }}" class="btn btn-success">Editar</a>
                            <input type="submit" class="btn btn-danger" value="Excluir"/>
                            <a href="{{ route('empresas.index') }}" class="btn btn-primary">Voltar</a>
                        </div>
                        <div class="form-group text-center">
                        </div>
                    </form>
                </div>
                <div class="card my-5">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Unidades</h3>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <tbody class="list">
                            @forelse($unidades as $unidade)
                                <tr>
                                    <td>
                                        <a class="text-sm" href="{{ route('unidades.show', $unidade->id) }}">{{ $unidade->municipio }}</a>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="{{ route('unidades.show', $unidade->id) }}">Ver</a>
                                                <a class="dropdown-item" href="{{ route('unidades.edit', $unidade->id) }}">Editar</a>
                                                <a class="dropdown-item" href="{{ route('unidades.destroy', $unidade->id) }}"
                                                   onclick="event.preventDefault(); document.getElementById('unidade-{{ $unidade->id }}').submit();">Excluir</a>
                                            </div>
                                        </div>
                                        <form id="unidade-{{ $unidade->id }}" method="post" action="{{ route('unidades.destroy', $unidade->id) }}">@csrf @method('DELETE')</form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">
                                        <p>Não há unidade cadastrada.</p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group text-center">
                        <a href="{{ route('unidades.create', $empresa->id) }}" class="btn btn-primary">Nova unidade</a>
                    </div>
                </div>
                <div class="card my-5">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Usuários</h3>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <tbody class="list">
                            @forelse($usuarios as $usuario)
                                <tr>
                                    <td>
                                        <a class="text-sm" href="{{ route('usuarios.show', $usuario->id) }}">{{ $usuario->nome }}</a>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="{{ route('usuarios.show', $usuario->id) }}">Ver</a>
                                                <a class="dropdown-item" href="{{ route('usuarios.edit', $usuario->id) }}">Editar</a>
                                                <a class="dropdown-item" href="{{ route('usuarios.destroy', $usuario->id) }}"
                                                   onclick="event.preventDefault(); document.getElementById('usuario-{{ $usuario->id }}').submit();">Excluir</a>
                                            </div>
                                        </div>
                                        <form id="usuario-{{ $usuario->id }}" method="post" action="{{ route('usuarios.destroy', $usuario->id) }}">@csrf @method('DELETE')</form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">
                                        <p>Não há usuário cadastrado.</p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group text-center">
                        <a href="{{ route('usuarios.create', $empresa->id) }}" class="btn btn-primary">Novo usuário</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmeExclusao(form) {
            if (confirm("Confirma excluir a empresa?")) {
                form.submit();
            }
        }
    </script>
@endsection
