@extends('layouts.app')

@section('content')
    @include('layouts.headers.atestados')
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Novo atestado</h3>
                    </div>
                    <form method="post" action="{{ route('atestados.store') }}" class="p-4">
                        @csrf
                        <input type="hidden" name="unidade_id" value="{{ $unidade->id }}">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="paciente">Paciente</label>
                                <div class="form-group @error('paciente') has-danger @enderror">
                                    <select class="form-control form-control-alternative @error('paciente') is-invalid @enderror"
                                            id="paciente_id" name="paciente_id" value="{{ old('paciente_id') }}">
                                        <option value="0"></option>
                                        @foreach($pacientes as $paciente)
                                            <option value="{{ $paciente->id }}">{{ $paciente->nome }}</option>
                                        @endforeach
                                    </select>
                                    @error('paciente')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="acompanhante">Acompanhante</label>
                                <div class="form-group @error('acompanhante') has-danger @enderror">
                                    <select class="form-control form-control-alternative @error('acompanhante') is-invalid @enderror"
                                            id="acompanhante_id" name="acompanhante_id" value="{{ old('acompanhante_id') }}">
                                        <option value="0"></option>
                                        @foreach($acompanhantes as $acompanhante)
                                            <option value="{{ $acompanhante->id }}">{{ $acompanhante->nome }}</option>
                                        @endforeach
                                    </select>
                                    @error('acompanhante')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="obito">Óbito</label>
                                <div class="form-group @error('obito') has-danger @enderror">
                                    <select class="form-control form-control-alternative @error('obito') is-invalid @enderror"
                                            id="obito_id" name="obito_id" value="{{ old('obito_id') }}">
                                        <option value="0"></option>
                                        @foreach($obitos as $obito)
                                            <option value="{{ $obito->id }}">{{ $obito->nome }}</option>
                                        @endforeach
                                    </select>
                                    @error('obito')
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
                                    <a href="{{ route('unidades.show', $unidade_id) }}" class="btn btn-primary">Voltar</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
