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
              <h3 class="mb-0">Lista de usuários</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="cpf">CPF</th>
                    <th scope="col" class="sort" data-sort="nome">Nome</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody class="list">
                  @foreach($usuarios as $usuario)
                  <tr>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <span class="name mb-0 text-sm">{{ $usuario->cpf }}</span>
                        </div>
                      </div>
                    </th>
                    <td class="budget">
                      {{ $usuario->nome }}
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
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- Card footer -->
            <div class="card-footer py-4">
              {{ $usuarios->links() }}
            </div>
          </div>
        </div>
      </div>
  @endsection
