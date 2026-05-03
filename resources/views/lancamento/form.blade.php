@extends('layout.main')

@section('content')

@include('sweetalert::alert')

    @php
        $isEdit = isset($lancamento);
        $titulo = $isEdit ? 'Editar lancamento' : 'Novo lancamento';
        $action = $isEdit ? route('lancamento.update', $lancamento->id) : route('lancamento.store');
    @endphp

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12 col-xl-8">
                <div class="card">
                     <div class="card-header">
                        <h4>{{ $titulo }}</h4><hr>
                    </div>
                    <div class="card-body">
                        <form action="{{ $action }}" method="POST" id="form-lancamento">
                            @csrf
                            @if ($isEdit)
                                @method('PUT')
                            @endif

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label class="form-label">Categoria</label>
                                    <select name="categoria_id" id="categoria_id" class="form-control select2 @error('categoria_id') is-invalid @enderror">
                                        <option value="" selected disabled>--Selecione--</option>
                                        @foreach ($categorias as $categoria)
                                            <option value="{{ $categoria->id }}" {{ old('categoria_id', $lancamento->categoria_id ?? null) == $categoria->id ? 'selected' : '' }}>
                                                {{ $categoria->descricao }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('categoria_id')
                                        <div class="invalid-feedback">{{ $message }}</div><br>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label">Tipo de Categoria</label>
                                    <select name="tipo_categoria_id" id="tipo_categoria_id" class="form-control select2 @error('tipo_categoria_id') is-invalid @enderror">
                                        <option value="" selected disabled>--Selecione--</option>
                                        @foreach ($tipoCategorias as $tipoCategoria)
                                            <option value="{{ $tipoCategoria->id }}" {{ old('tipo_categoria_id', $lancamento->tipo_categoria_id ?? null) == $tipoCategoria->id ? 'selected' : '' }}>
                                                {{ $tipoCategoria->descricao }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tipo_categoria_id')
                                        <div class="invalid-feedback">{{ $message }}</div><br>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="competencia" class="form-label">Competência (MM/AAAA)</label>
                                    <input type="text" class="form-control competencia-mask @error('competencia') is-invalid @enderror"
                                        id="competencia" name="competencia" value="{{ old('competencia', $lancamento->competencia ?? now()->format('m/Y')) }}" placeholder="05/2026">
                                    @error('competencia')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-8">
                                    <label for="descricao" class="form-label">Descrição</label>
                                    <input type="text" class="form-control @error('descricao') is-invalid @enderror"
                                        id="descricao" name="descricao" value="{{ old('descricao', $lancamento->descricao ?? null) }}"
                                        placeholder="Ex: Aluguel - Bairro Nova Campo Grande">
                                    @error('descricao')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label">Responsável</label>
                                    <select name="responsavel_id" id="responsavel_id" class="form-control select2 @error('responsavel_id') is-invalid @enderror">
                                        <option value="" selected disabled>--Selecione--</option>
                                        @foreach ($responsaveis as $responsavel)
                                            <option value="{{ $responsavel->id }}" {{ old('responsavel_id', $lancamento->responsavel_id ?? null) == $responsavel->id ? 'selected' : '' }}>
                                                {{ $responsavel->nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('responsavel_id')
                                        <div class="invalid-feedback">{{ $message }}</div><br>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="data_vencimento" class="form-label">Data vencimento</label>
                                    <input type="date" class="form-control @error('data_vencimento') is-invalid @enderror"
                                        id="data_vencimento" name="data_vencimento" value="{{ old('data_vencimento', $lancamento->data_vencimento ?? null) }}">
                                    @error('data_vencimento')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="data_pagamento" class="form-label">Data pagamento</label>
                                    <input type="date" class="form-control @error('data_pagamento') is-invalid @enderror"
                                        id="data_pagamento" name="data_pagamento" value="{{ old('data_pagamento', $lancamento->data_pagamento ?? null) }}">
                                    @error('data_pagamento')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="valor" class="form-label">Valor</label>
                                    <div class="input-group">
                                        <span class="input-group-text">R$</span>
                                        <input type="text" class="form-control valor @error('valor') is-invalid @enderror"
                                            id="valor" name="valor" value="{{ old('valor', $lancamento->valor ?? null) }}" placeholder="0,00">
                                        @error('valor')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="valor_casal" class="form-label">Valor Casal</label>
                                    <div class="input-group">
                                        <span class="input-group-text">R$</span>
                                        <input type="text" class="form-control valor @error('valor_casal') is-invalid @enderror"
                                            id="valor_casal" name="valor_casal" value="{{ old('valor_casal', $lancamento->valor_casal ?? null) }}" placeholder="0,00">
                                        @error('valor_casal')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="valor_deborah" class="form-label">Valor Déborah</label>
                                    <div class="input-group">
                                        <span class="input-group-text">R$</span>
                                        <input type="text" class="form-control valor @error('valor_deborah') is-invalid @enderror"
                                            id="valor_deborah" name="valor_deborah" value="{{ old('valor_deborah', $lancamento->valor_deborah ?? null) }}" placeholder="0,00">
                                        @error('valor_deborah')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="valor_wangley" class="form-label">Valor Wangley</label>
                                    <div class="input-group">
                                        <span class="input-group-text">R$</span>
                                        <input type="text" class="form-control valor @error('valor_wangley') is-invalid @enderror"
                                            id="valor_wangley" name="valor_wangley" value="{{ old('valor_wangley', $lancamento->valor_wangley ?? null) }}" placeholder="0,00">
                                        @error('valor_wangley')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="deborah_falta_pagar" class="form-label">Déborah falta pagar</label>
                                    <div class="input-group">
                                        <span class="input-group-text">R$</span>
                                        <input type="text" class="form-control valor @error('deborah_falta_pagar') is-invalid @enderror"
                                            id="deborah_falta_pagar" name="deborah_falta_pagar" value="{{ old('deborah_falta_pagar', $lancamento->deborah_falta_pagar ?? null) }}" placeholder="0,00">
                                        @error('deborah_falta_pagar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="wangley_falta_pagar" class="form-label">Wangley falta pagar</label>
                                    <div class="input-group">
                                        <span class="input-group-text">R$</span>
                                        <input type="text" class="form-control valor @error('wangley_falta_pagar') is-invalid @enderror"
                                            id="wangley_falta_pagar" name="wangley_falta_pagar" value="{{ old('wangley_falta_pagar', $lancamento->wangley_falta_pagar ?? null) }}" placeholder="0,00">
                                        @error('wangley_falta_pagar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label class="form-label">Parcelamento</label>
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="is_parcelado" name="is_parcelado" value="1"
                                            {{ old('is_parcelado', $lancamento->is_parcelado ?? null) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_parcelado">Parcelado?</label>
                                    </div>
                                </div>
                                <div id="campos-parcelamento" class="row {{ old('is_parcelado', $lancamento->is_parcelado ?? null) ? '' : 'd-none' }}">
                                    <div class="form-group col-md-4">
                                        <label for="parcela_atual" class="form-label">Parcela atual</label>
                                        <input type="number" class="form-control @error('parcela_atual') is-invalid @enderror"
                                            id="parcela_atual" name="parcela_atual" value="{{ old('parcela_atual', $lancamento->parcela_atual ?? 1) }}" min="1">
                                        @error('parcela_atual')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="total_parcelas" class="form-label">Total de parcelas</label>
                                        <input type="number" class="form-control @error('total_parcelas') is-invalid @enderror" id="total_parcelas"
                                            name="total_parcelas" value="{{ old('total_parcelas', $lancamento->total_parcelas ?? null) }}" min="1">
                                        @error('total_parcelas')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="valor_parcela" class="form-label">Valor por parcela</label>
                                        <div class="input-group">
                                            <span class="input-group-text">R$</span>
                                            <input type="text" class="form-control money-mask @error('valor_parcela') is-invalid @enderror" id="valor_parcela"
                                                name="valor_parcela" value="{{ old('valor_parcela', $lancamento->valor_parcela ?? null) }}" placeholder="0,00">
                                            @error('valor_parcela')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <span>Status e recorrência</span>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" id="is_receber" name="is_receber" value="1"
                                            {{ old('is_receber', $lancamento->is_receber ?? null) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_receber">A receber?</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" id="is_pago" name="is_pago" value="1"
                                            {{ old('is_pago', $lancamento->is_pago ?? null) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_pago">Já foi pago?</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" id="is_fixo" name="is_fixo" value="1"
                                            {{ old('is_fixo', $lancamento->is_fixo ?? null) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_fixo">Lançamento fixo?</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="observacao" class="form-label">Observação</label>
                                    <textarea class="form-control" id="observacao" name="observacao" rows="2">
                                        {{ old('observacao', $lancamento->observacao ?? null) }}
                                    </textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="link_pagamento" class="form-label">Link de pagamento (opcional)</label>
                                    <input type="url" class="form-control" id="link_pagamento" name="link_pagamento"
                                        value="{{ old('link_pagamento', $lancamento->link_pagamento ?? null) }}" placeholder="https://...">
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="button_submit btn btn-primary mr-2"><i class="fas fa-save"></i>&nbsp Salvar</button>
                                <a type="button" class="btn btn-secondary" href="{{ route('lancamento.index') }}"><i class="fas fa-redo"></i>&nbsp Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-4">
                <div class="card mb-3 border-0 shadow-sm">
                    <div class="card-header bg-white border-0 pb-0">
                        <h5 class="card-title mb-1 h4">
                            <i class="fas fa-lightbulb text-warning mr-2"></i>Dicas de preenchimento
                        </h5>
                        <p class="text-muted mb-0" style="font-size: 0.80rem;">Guia rápido para evitar erros e manter seus lançamentos organizados.</p>
                    </div>
                    <div class="card-body pt-3">
                        <div class="d-flex align-items-start mb-3 p-2 rounded bg-light">
                            <i class="fas fa-users text-primary mt-1 mr-3"></i>
                            <div>
                                <h6 class="mb-1" style="font-size: 1rem;">Rateio do casal</h6>
                                <p class="text-muted mb-0" style="font-size: 0.80rem;">Preencha <strong>Valor Déborah</strong>, <strong>Valor Wangley</strong> e <strong>Valor Casal</strong> quando a despesa for compartilhada.</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-3 p-2 rounded bg-light">
                            <i class="fas fa-hand-holding-usd text-success mt-1 mr-3"></i>
                            <div>
                                <h6 class="mb-1" style="font-size: 1rem;">Lançamento a receber</h6>
                                <p class="text-muted mb-0" style="font-size: 0.80rem;">Ative <strong>A receber?</strong> para valores que ainda vão entrar no caixa.</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-3 p-2 rounded bg-light">
                            <i class="fas fa-calendar-check text-info mt-1 mr-3"></i>
                            <div>
                                <h6 class="mb-1" style="font-size: 1rem;">Controle de pagamento</h6>
                                <p class="text-muted mb-0" style="font-size: 0.80rem;">Se marcar <strong>Ja foi pago?</strong>, informe a <strong>Data de pagamento</strong> para manter o histórico correto.</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start p-2 rounded bg-light">
                            <i class="fas fa-credit-card text-danger mt-1 mr-3"></i>
                            <div>
                                <h6 class="mb-1" style="font-size: 1rem;">Compras parceladas</h6>
                                <p class="text-muted mb-0" style="font-size: 0.80rem;">Ative <strong>Parcelado?</strong> e preencha parcela atual, total de parcelas e valor por parcela.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
   <script>
        $('.valor').mask('00.000.000,00', {reverse: true});
        $('.competencia-mask').mask('00/0000');

        $(document).ready(function() {
            const $parcelado = $('#is_parcelado');
            const $camposParcelamento = $('#campos-parcelamento');

            function toggleCamposParcelamento() {
                $camposParcelamento.toggleClass('d-none', !$parcelado.is(':checked'));
            }

            toggleCamposParcelamento();
            $parcelado.on('change', toggleCamposParcelamento);

            $('.select2').select2({
                language: {
                    noResults: function() {
                        return "Nenhum resultado encontrado";
                    }
                },
                closeOnSelect: true,
                width: '100%',
            });
        });
    </script>
@endsection
