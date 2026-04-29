@extends('layout.main')

@section('content')

    @include('sweetalert::alert')

    <div class="card" style="background-color:white">
        <div class="card-header">
            <h4>Listagem de Usuários</h4><hr>
        </div>

        <div class="card-body">
            <div class="col-md-12 text-left mt-0 pt-0 mb-4">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCadastrar">
                    <i class="fas fa-plus-square"></i>&nbsp Cadastrar Usuário
                </button>
            </div>
            @if ($users->isEmpty())
                <div>
                    <h1 class="alert-info px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Não há Usuários Cadastrados</h1>
                </div>
            @else
                <div class="table-responsive">
                    <table id="datatables-reponsive" class="table table-bordered" style="width: 100%;">
                        <thead style="background-color:#e2e7e6">
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger m-1" data-toggle="modal" data-target="#modalExcluir{{ $user->id }}"
                                            title="excluir"><i class="fas fa-trash-alt"></i></button>
                                        <button type="button" class="btn btn-warning m-1" data-toggle="modal" data-target="#modalAlterar{{ $user->id }}"
                                            title="excluir"><i class="fas fa-pen"></i></button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="modalAlterar{{ $user->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="modalAlterar{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form method="POST" class="form_prevent_multiple_submits" action="{{ route('configuracao.usuario.update', $user->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header btn-warning">
                                                    <h5 class="modal-title text-center" id="modalLabelAlterar{{ $user->id }}">
                                                        Editar Usuário
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label">*Nome</label>
                                                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') ?? $user->name }}">
                                                        </div>
                                                        @error('name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label">*E-mail</label>
                                                            <input class="form-control @error('email') is-invalid @enderror" type="text" name="email"
                                                                id="email" placeholder="Informe o e-mail" value="{{ old('email') ?? $user->email }}">
                                                            @error('email')
                                                                <div class="invalid-feedback">{{ $message }}</div><br>
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

                                <div class="modal fade" id="modalExcluir{{ $user->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="modalLabelExcluir{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form method="POST" class="form_prevent_multiple_submits" action="{{ route('configuracao.usuario.destroy', $user->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header btn-danger">
                                                    <h5 class="modal-title text-center" id="modalLabelExcluir{{ $user->id }}">
                                                        Excluir Usuário
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group col-md-12 mb-3">
                                                        Tem certeza que deseja excluir o usuário <strong>{{ $user->name }}</strong>?
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <form method="POST" class="form_prevent_multiple_submits" action="{{ route('configuracao.usuario.store') }}">
                    @csrf

                    <div class="modal-header btn-info">
                        <h5 class="modal-title text-center" id="modalLabelCadastrar">
                            Cadastrar Usuário
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label">*Nome</label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                                    id="name" placeholder="Informe o nome" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div><br>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">*E-mail</label>
                                <input class="form-control @error('email') is-invalid @enderror" type="text" name="email"
                                    id="email" placeholder="Informe o e-mail" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div><br>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">*Senha</label>
                                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password"
                                    id="password" placeholder="Informe a senha" value="{{ old('password') }}">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div><br>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">*Confirmação</label>
                                <input class="form-control @error('confirmacao') is-invalid @enderror" type="password" name="confirmacao"
                                    id="confirmacao" placeholder="Confirme a senha" value="{{ old('confirmacao') }}">
                                @error('confirmacao')
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
