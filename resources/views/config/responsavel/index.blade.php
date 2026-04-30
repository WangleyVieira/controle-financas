@extends('layout.main')

@section('content')

    @include('sweetalert::alert')

    <div class="card" style="background-color:white">
        <div class="card-header">
            <h4>Listagem de Responsáveis</h4><hr>
        </div>

        <div class="card-body">
            <div class="col-md-12 text-left mt-0 pt-0 mb-4">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCadastrar">
                    <i class="fas fa-plus-square"></i>&nbsp Cadastrar Responsável
                </button>
            </div>
            @if ($responsaveis->isEmpty())
                <div>
                    <h1 class="alert-info px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Não há responsáveis cadastrados</h1>
                </div>
            @else
                <div class="table-responsive">
                    <table id="datatables-reponsive" class="table table-bordered" style="width: 100%;">
                        <thead style="background-color:#e2e7e6">
                            <tr>
                                <th>ID</th>
                                <th>Descrição</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($responsaveis as $responsavel)
                                <tr>
                                    <td>{{ $responsavel->id }}</td>
                                    <td>{{ $responsavel->nome }}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger m-1" data-toggle="modal" data-target="#modalExcluir{{ $responsavel->id }}"
                                            title="excluir"><i class="fas fa-trash-alt"></i></button>
                                        <button type="button" class="btn btn-warning m-1" data-toggle="modal" data-target="#modalAlterar{{ $responsavel->id }}"
                                            title="excluir"><i class="fas fa-pen"></i></button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="modalAlterar{{ $responsavel->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="modalLabelExcluir{{ $responsavel->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form method="POST" class="form_prevent_multiple_submits" action="{{ route('configuracao.responsavel.update', $responsavel->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header btn-warning">
                                                    <h5 class="modal-title text-center" id="modalLabelExcluir{{ $responsavel->id }}">
                                                        Editar Responsável
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label class="form-label">*Nome</label>
                                                            <input class="form-control @error('nome') is-invalid @enderror" type="text" name="nome" value="{{ $responsavel->nome }}">
                                                             @error('nome')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-redo"></i>&nbsp Cancelar</button>
                                                    <button type="submit" class="button_submit btn btn-primary"><i class="fas fa-save"></i>&nbsp Salvar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="modalExcluir{{ $responsavel->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="modalLabelExcluir{{ $responsavel->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form method="POST" class="form_prevent_multiple_submits" action="{{ route('configuracao.responsavel.destroy', $responsavel->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header btn-danger">
                                                    <h5 class="modal-title text-center" id="modalLabelExcluir{{ $responsavel->id }}">
                                                        Excluir Responsável
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group col-md-12 mb-3">
                                                        Tem certeza que deseja excluir o(a) responsável <strong>{{ $responsavel->nome }}</strong>?
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
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    {{-- Modal para cadastrar --}}
    <div class="modal fade" id="modalCadastrar" tabindex="-1" role="dialog" aria-labelledby="modalLabelCadastrar" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                <form method="POST" class="form_prevent_multiple_submits" action="{{ route('configuracao.responsavel.store') }}">
                    @csrf
                    <div class="modal-header btn-info">
                        <h5 class="modal-title text-center" id="modalLabelCadastrar">
                            Cadastrar Responsável
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="form-label">*Nome</label>
                                <input class="form-control @error('nome') is-invalid @enderror" type="text" name="nome"
                                    id="nome" placeholder="Informe o nome" value="{{ old('nome') }}">
                                @error('nome')
                                    <div class="invalid-feedback">{{ $message }}</div><br>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="button_submit btn btn-primary"><i class="fas fa-save"></i>&nbsp Salvar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-redo"></i>&nbsp Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@if($errors->any())
    @section('scripts')
        <script>
            $(document).ready(function() {
                $('#modalCadastrar').modal('show');
            });
        </script>
    @endsection
@endif

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
