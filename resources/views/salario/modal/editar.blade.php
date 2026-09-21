@foreach ($entradasSalarios as $entradaSalario)
    <div class="modal fade" id="modalEditarSalario{{ $entradaSalario->id }}" tabindex="-1" role="dialog"
        aria-labelledby="modalEditarSalarioLabel{{ $entradaSalario->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('entrada_salario.update', $entradaSalario->id) }}" class="form_prevent_multiple_submits">
                    @csrf
                    @method('PUT')
                    <div class="modal-header btn-warning">
                        <h5 class="modal-title text-center" id="modalEditarSalarioLabel{{ $entradaSalario->id }}">
                            Editar Salário
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="competencia_{{ $entradaSalario->id }}" class="form-label">Competência (MM/AAAA)</label>
                                <input type="text" class="form-control competencia-mask @error('competencia') is-invalid @enderror"
                                    id="competencia_{{ $entradaSalario->id }}" name="competencia"
                                    value="{{ old('competencia', $entradaSalario->competencia) }}"
                                    placeholder="05/2026">
                                @error('competencia')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="valor_salario_{{ $entradaSalario->id }}" class="form-label">Valor do salário</label>
                                <div class="input-group">
                                    <span class="input-group-text">R$</span>
                                    <input type="text" class="form-control valor @error('valor_salario') is-invalid @enderror"
                                        id="valor_salario_{{ $entradaSalario->id }}" name="valor_salario"
                                        value="{{ old('valor_salario', $entradaSalario->valor_salario) }}"
                                        placeholder="0,00">
                                </div>
                                @error('valor_salario')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <label for="descricao_{{ $entradaSalario->id }}" class="form-label">Descrição</label>
                            <input type="text" class="form-control @error('descricao') is-invalid @enderror"
                                id="descricao_{{ $entradaSalario->id }}" name="descricao"
                                value="{{ old('descricao', $entradaSalario->descricao) }}"
                                placeholder="Ex: Salário mensal - empresa">
                            @error('descricao')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-redo"></i>&nbsp Cancelar</button>
                        <button type="submit" class="button_submit btn btn-warning"><i class="fas fa-save"></i>&nbsp Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
