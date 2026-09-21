@extends('layout.main')

@section('content')
    @include('sweetalert::alert')

    <div class="card" style="background-color:white">
        <div class="card-header">
            <h4>Listagem de Salários</h4>
        </div>

        <div class="card-body">
            <div class="col-md-12 text-left mt-0 pt-0 mb-4">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCadastrarSalario">
                    <i class="fas fa-plus-square"></i>&nbsp Cadastrar Salário
                </button>
            </div>
            @if ($entradasSalarios->isEmpty())
                <div>
                    <h1 class="alert-info px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Não há salários cadastrados</h1>
                </div>
            @else
                <div class="table-responsive">
                    <table id="datatable-salarios" class="table table-bordered" style="width: 100%;">
                        <thead style="background-color:#e2e7e6">
                            <tr>
                                <th>Competência</th>
                                <th>Descrição</th>
                                <th>Valor</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($entradasSalarios as $entradaSalario)
                                <tr>
                                    <td>{{ $entradaSalario->competencia ?? '-' }}</td>
                                    <td>{{ $entradaSalario->descricao ?? '-' }}</td>
                                    <td>R$ {{ number_format((float) $entradaSalario->valor_salario, 2, ',', '.') }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning m-1" data-toggle="modal" data-target="#modalEditarSalario{{ $entradaSalario->id }}" title="editar">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger m-1" data-toggle="modal" data-target="#modalExcluirSalario{{ $entradaSalario->id }}" title="excluir">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    @include('salario.modal.cadastrar')

    @include('salario.modal.editar')

    @foreach ($entradasSalarios as $entradaSalario)
        <div class="modal fade" id="modalExcluirSalario{{ $entradaSalario->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modalLabelExcluirSalario{{ $entradaSalario->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" class="form_prevent_multiple_submits" action="{{ route('entrada_salario.destroy', $entradaSalario->id) }}">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header btn-danger">
                            <h5 class="modal-title text-center" id="modalLabelExcluirSalario{{ $entradaSalario->id }}">
                                Excluir Salário
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group col-md-12 mb-3">
                                Tem certeza que deseja excluir o salário <strong>{{ $entradaSalario->descricao }}</strong> da competência <strong>{{ $entradaSalario->competencia }}</strong>?
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-redo"></i>&nbsp Cancelar</button>
                            <button type="submit" class="button_submit btn btn-danger"><i class="fas fa-trash"></i>&nbsp Confirmar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#datatable-salarios').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json'
                },
                responsive: true
            });

            $('.competencia-mask').mask('00/0000');
            $('.valor').mask('#.##0,00', { reverse: true });

            @if ($errors->any())
                $('#modalCadastrarSalario').modal('show');
            @endif
        });
    </script>
@endsection

