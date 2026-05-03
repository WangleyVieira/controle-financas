@extends('layout.main')

@section('content')

    @include('sweetalert::alert')

    <div class="card" style="background-color:white">
        <div class="card-header">
            <h4>Listagem de Lançamentos</h4><hr>
        </div>

        <div class="card-body">
            <div class="col-md-12 text-left mt-0 pt-0 mb-4">
                <a type="button" class="btn btn-success" href="{{ route('lancamento.create') }}">
                    <i class="fas fa-plus-square"></i>&nbsp Cadastrar Lançamento
                </a>
            </div>
            @if ($lancamentos->isEmpty())
                <div>
                    <h1 class="alert-info px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Não há lançamentos cadastrados</h1>
                </div>
            @else
                <div class="table-responsive">
                    <table id="datatables-reponsive" class="table table-bordered" style="width: 100%;">
                        <thead style="background-color:#e2e7e6">
                            <tr>
                                <th>ID</th>
                                <th>Descrição</th>
                                <th>Responsável</th>
                                <th>Tipo de Categoria</th>
                                <th>Valor</th>
                                <th>Competência(referência mensal)</th>
                                <th>Já foi pago?</th>
                                <th>A receber?</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lancamentos as $lancamento)
                                <tr>
                                    <td>{{ $lancamento->id }}</td>
                                    <td>{{ $lancamento->descricao }}</td>
                                    <td>{{ $lancamento->responsavel_id != null ? $lancamento->responsavel->nome : '' }}</td>
                                    <td>{{ $lancamento->tipo_categoria_id != null ? $lancamento->tipoCategoria->descricao : '' }}</td>
                                    <td>R$ {{ number_format($lancamento->valor, 2, ',', '.') }}</td>
                                    <td>{{ $lancamento->competencia }}</td>
                                    <td>
                                        @if ($lancamento->is_pago)
                                            <span class="badge badge-success">Sim</span>
                                        @else
                                            <span class="badge badge-danger">Não</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($lancamento->is_receber)
                                            <span class="badge badge-success">Sim</span>
                                        @else
                                            <span class="badge badge-danger">Não</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger m-1" data-toggle="modal" data-target="#modalExcluir{{ $lancamento->id }}"
                                            title="excluir"><i class="fas fa-trash-alt"></i></button>
                                        <a type="button" class="btn btn-warning m-1" href="{{ route('lancamento.edit', $lancamento->id) }}"
                                            title="editar"><i class="fas fa-pen"></i></a>
                                    </td>
                                </tr>

                                {{-- <div class="modal fade" id="modalExcluir{{ $lancamento->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="modalLabelExcluir{{ $lancamento->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form method="POST" class="form_prevent_multiple_submits" action="{{ route('configuracao.lancamento.destroy', $lancamento->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header btn-danger">
                                                    <h5 class="modal-title text-center" id="modalLabelExcluir{{ $lancamento->id }}">
                                                        Excluir Lançamento
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group col-md-12 mb-3">
                                                        Tem certeza que deseja excluir categoria <strong>{{ $categoria->descricao }}</strong>?
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-redo"></i>&nbsp Cancelar</button>
                                                    <button type="submit" class="button_submit btn btn-danger"><i class="fas fa-trash"></i>&nbsp Confirmar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                language: {
                    noResults: function() {
                        return "Nenhum resultado encontrado";
                    }
                },
                closeOnSelect: true,
                width: '100%',
            });

            $('#datatables-reponsive').dataTable({
                "oLanguage": {
                    "sLengthMenu": "Mostrar _MENU_ registros por página",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sInfo": "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
                    "sInfoEmpty": "Mostrando 0 / 0 de 0 registros",
                    "sInfoFiltered": "(filtrado de _MAX_ registros)",
                    "sSearch": "Pesquisar: ",
                    "oPaginate": {
                        "sFirst": "Início",
                        "sPrevious": "Anterior",
                        "sNext": "Próximo",
                        "sLast": "Último"
                    }
                },
            });
        });
    </script>
@endsection
