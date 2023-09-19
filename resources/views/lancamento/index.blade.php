@extends('layouts.base')
@section('content')
    <h1>
        LANÇAMENTO
        |
        <a class="btn btn-primary" href="{{ route('lancamento.create') }}">
            Novo lançamento
        </a>
    </h1>
    {{-- <h2>{{ Auth::user()->name }}</h2> --}}

    {{-- alerts --}}
    @include('layouts.partials.alerts')
    {{-- /alerts --}}

    {{-- paginação --}}
    {!! $lancamentos->appends([
            'search' => request()->get('search', ''),
        ])->links() !!}
    {{-- /paginação --}}
    {{-- pesquisa --}}
    <div class="row">
        <form action="{{ route('lancamento.index') }}" method="get">
            <input class="form-control col-md-4" type="search" name="search" id="search"
                placeholder="Digite o que deseja pesquisar..." value="{{ old('search', request()->get('search')) }}">

            {{-- data inicial --}}
            <div class="col-md-3">
                <label class="form-label" for="dt_inicial">
                    Data inicial
                </label>
                <input class="form-control" type="date" name="dt_inicial" id="dt_inicial">
            </div>
            {{-- /data inicial --}}
            {{-- data final --}}
            <div class="col-md-3">
                <label class="form-label" for="dt_final">
                    Data final
                </label>
                <input class="form-control" type="date" name="dt_final" id="dt_final">
            </div>
            {{-- /data final --}}

            {{-- tipo --}}
            <div class="col-md-3">
                <label for="id_tipo" class="form-label">Tipo*</label>
                <select id="id_tipo" class="form-select" name="id_tipo">
                    <option value="">Escolha...</option>
                    @foreach ($tipos::orderBy('tipo')->get() as $tipo)
                        <option value="{{ $tipo->id_tipo }}">
                            {{ $tipo->tipo }}
                        </option>
                    @endforeach
                </select>
            </div>
            {{-- \tipo --}}

            {{-- centroCusto --}}
            <div class="col-md-3">
                <label for="id_centro_custo" class="form-label">Centro de Custo*</label>
                <select id="id_centro_custo" class="form-select" name="id_centro_custo">
                    <option value="">Escolha...</option>
                    @foreach ($centros::orderBy('centro_custo')->get() as $centro)
                        <option value="{{ $centro->id_centro_custo }}">
                            {{ $centro->centro_custo }}
                    @endforeach
                </select>
            </div>
            {{-- \centroCusto --}}

            <input class="btn btn-primary col-md-1" type="submit" value="Pesquisar">
            @if (request()->get('search') != '')
                <a class="btn btn-dark col-md-1" href="{{ route('lancamento.index') }}">
                    Limpar
                </a>
            @endif

        </form>
    </div>
    {{-- /pesquisa --}}


    <div class="table-responsive">
        <table class="table table-striped  table-hover ">
            <thead>
                <caption>LISTA DE</caption>
                <tr>
                    <th>#</th>
                    <th>Vencimento</th>
                    <th>Tipo</th>
                    <th>Valor</th>
                    <th>Centro de custo</th>
                    <th>Descrição</th>
                    <th>Usuario</th>
                    <th>Dta do lançamento</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">

                @forelse ($lancamentos as $lancamento)
                    <tr>
                        <td scope="row" class="col-2">
                            <div class="flex-column">
                                {{-- ver anexo --}}
                                @if ($lancamento->anexo)
                                    <a class="btn btn-success" href="{{ Storage::url('/anexos/' . $lancamento->anexo) }}"
                                        target="_blank">
                                        <i class="bi bi-paperclip"></i>
                                @endif
                                </a>
                                {{-- editar --}}
                                <a class="btn btn-dark" href="#">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                {{-- excluir --}}
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalExcluir" data-identificacao="" data-url="">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                        <td>{{ $lancamento->vencimento->format('d/m/Y') }}</td>
                        <td>{{ $lancamento->tipo->tipo }}</td>
                        <td>R${{ $lancamento->valor }}</td>
                        <td>{{ $lancamento->centroCusto->centro_custo }}</td>
                        <td>{{ $lancamento->descricao }}</td>
                        <td>{{ $lancamento->usuario->name }}</td>
                        <td>{{ $lancamento->created_at->format('d/m/Y \a\s H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        {{-- COLSPAN = Para ocupar o espaço de TR (Colunas) --}}
                        <td colspan="8">
                            Nenhum registro retornado
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Modal Excluir --}}
    @include('layouts.partials.modalExcluir')
    {{-- /Modal Excluir --}}
@endsection
@section('scripts')
    @parent
@endsection
