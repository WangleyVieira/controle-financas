@extends('layout.main')

@section('content')
    @include('sweetalert::alert')

    <div class="container-fluid p-0">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    {{-- <a href="{{ route('acesso_interno.configuracao.usuario.create') }}" style="float: right"
                        class="submit-button btn btn-success mb-2"><i class="fas fa-user-plus"></i>&nbsp Cadastrar usuário</a> --}}
                    @if ($entradasSalarios->isEmpty())
                        <div>
                            <h1 class="alert-info px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Não há cadastros no sistema.</h1>
                        </div>
                    @else
                        <div class="table-responsive" style="width: 100%;">
                            <table class="table table-bordered text-center" style="width: 100%" id="datatables-reponsive">
                                <thead class="table-secondary">
                                    <tr>
                                        <th class="text-center" scope="col">Competência</th>
                                        <th class="text-center" scope="col">Descrição</th>
                                        <th class="text-center" scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($entradasSalarios as $entradaSalario)
                                        <tr id="{{ $entradaSalario->id }}">
                                            <td class="text-center">{{ $entradaSalario->competencia ?? '-' }}</td>
                                            <td class="cpf text-center">{{ $entradaSalario->descricao ?? '-' }}</td>
                                            <td>
                                                <button title="excluir" type="button" class="btn btn-danger m-1" data-toggle="modal" data-target="#exampleModalExcluir{{ $entradaSalario->id }}"><i class="fas fa-trash"></i></button>
                                                <a href="#" class="btn btn-warning m-1" title="editar"><i class="fas fa-user-edit"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- {{ $usuarios->links('vendor.pagination.bootstrap-4') }} --}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection




