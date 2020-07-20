<!-- Header -->
<div class="header bg-primary pt-6 pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Atestados</h6>
                    <p class="text-white">{{ $unidade_municipio }}</p>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <a href="{{ route('atestados.create', $unidade_id) }}" class="btn btn-sm btn-neutral">Novo atestado</a>
                </div>
            </div>
        </div>
    </div>
</div>
