<div class="modal fade" id="modalCadastrarSalario" tabindex="-1" role="dialog" aria-labelledby="modalCadastrarSalarioLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('entrada_salario.store') }}" class="form_prevent_multiple_submits">
                @csrf
                <div class="modal-header btn-success">
                    <h5 class="modal-title text-center" id="modalCadastrarSalarioLabel">
                        Cadastrar Salário
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="competencia" class="form-label">Competência (MM/AAAA)</label>
                            <input type="text" class="form-control competencia-mask @error('competencia') is-invalid @enderror"
                                id="competencia" name="competencia"
                                value="{{ old('competencia', now()->format('m/Y')) }}"
                                placeholder="05/2026">
                            @error('competencia')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="valor_salario" class="form-label">Valor do salário</label>
                            <div class="input-group">
                                <span class="input-group-text">R$</span>
                                <input type="text" class="form-control valor @error('valor_salario') is-invalid @enderror"
                                    id="valor_salario" name="valor_salario"
                                    value="{{ old('valor_salario') }}"
                                    placeholder="0,00">
                            </div>
                            @error('valor_salario')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <input type="text" class="form-control @error('descricao') is-invalid @enderror"
                            id="descricao" name="descricao"
                            value="{{ old('descricao') }}"
                            placeholder="Ex: Salário mensal - empresa">
                        @error('descricao')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-redo"></i>&nbsp Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
