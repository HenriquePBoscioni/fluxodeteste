@extends('layouts.base')
@section('content')
    <h1>
        <i class="bi bi-list-check"></i>
        Centro de Custo
        -
        <a class="btn btn-primary" href="{{ route('centro.create') }}">
            Novo centro de custo
        </a>
    </h1>

    {{-- alerts --}}
    @include('layouts.partials.alerts')
    {{-- /alerts --}}
    {{-- paginaçao --}}
        {!! $lancamentos->links() !!}
    {{-- /paginaçao --}}

    <div class="table-responsive">
        <table class="table table-striped  table-hover ">
            <thead>
                <caption>LISTA DE</caption>
                <tr>
                    <th class="col-2">#</th>
                    <th>Data</th>
                    <th>Tipo</th>
                    <th>Valor</th>
                    <th>Centro de Custo</th>
                    <th>Descrição</th>
                    <th>Usuário</th>
                    <th>Data do Lançamento</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @forelse ( as )

                    <tr>
                        <td scope="row">
                            <div class="flex-column">
                                {{-- ver --}}
                                <a class="btn btn-success"
                                    href="{{ route('centro.show',
                                                  ['id'=>$centro->id_centro_custo]
                                                  ) }}">
                                    <i class="bi bi-eye"></i>
                                </a>
                                {{-- editar --}}
                                <a class="btn btn-dark"
                                    href="{{ route('centro.edit', ['id' => $centro->id_centro_custo]) }}">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                {{-- excluir --}}
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalExcluir"
                                    data-identificacao="{{ $centro->centro_custo }}"
                                    data-url="{{ route('centro.destroy',
                                     ['id' => $centro->id_centro_custo]) }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                        <td>Item1</td>
                        <td>Item2</td>
                        <td>Item3</td>
                        <td>Item4</td>
                        <td>Item5</td>
                        <td>Item6</td>
                        <td>Item7</td>
                    </tr>
                    @empty
                    <tr>
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
