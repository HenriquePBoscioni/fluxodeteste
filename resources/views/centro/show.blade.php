@extends('layouts.base')
@section('content')
    <h1>Show</h1>
    <table class="table table-striped  table-hover ">

        <thead>
            <caption>LISTA DE</caption>
            <tr>
                <th class="col-2">#</th>
                <th>ID</th>
                <th>Descrição</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($centro as $centro)
            <tr>
                <td>

                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
@endsection
@section('scripts')
    @parent
@endsection
