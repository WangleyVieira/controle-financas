@extends('layout.main')

@section('title', 'Novo Lançamento')

@section('content')
<div class="container-fluid p-0">
    <div class="row">
        {{-- Formulário principal --}}
        <div class="col-12 col-xl-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Novo lançamento</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('lancamento.store') }}" method="POST" id="form-lancamento">
                        @csrf
                        <div class="row">
                            <div class="d-flex gap-2 flex-wrap form-group col-md-6">
                                <label class="form-label">Categoria</label>
                                <select name="categoria_id" id="categoria_id" class="form-control select2 @error('categoria_id') is-invalid @enderror">
                                    <option value="" selected disabled>--Selecione--</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                            {{ $categoria->descricao }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('categoria_id')
                                    <div class="invalid-feedback">{{ $message }}</div><br>
                                @enderror
                            </div>
                            <div class="d-flex gap-2 flex-wrap form-group col-md-6">
                                <label class="form-label">Tipo de Categoria</label>
                                <select name="tipo_categoria_id" id="tipo_categoria_id" class="form-control select2 @error('tipo_categoria_id') is-invalid @enderror">
                                    <option value="" selected disabled>--Selecione--</option>
                                    @foreach ($tipoCategorias as $tipoCategoria)
                                        <option value="{{ $tipoCategoria->id }}" {{ old('tipo_categoria_id') == $tipoCategoria->id ? 'selected' : '' }}>
                                            {{ $tipoCategoria->descricao }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tipo_categoria_id')
                                    <div class="invalid-feedback">{{ $message }}</div><br>
                                @enderror
                            </div>
                        </div>

                        {{-- Descrição --}}
                        <div class="row">
                            <div class="d-flex gap-2 flex-wrap form-group col-md-8">
                                <label for="descricao" class="form-label">Descrição</label>
                                <input type="text" class="form-control @error('descricao') is-invalid @enderror"
                                    id="descricao" name="descricao" value="{{ old('descricao') }}"
                                    placeholder="Ex: Aluguel — Bairro Nova Campo Grande">
                                @error('descricao') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="d-flex gap-2 flex-wrap form-group col-md-4">
                                <label class="form-label">Responsável</label>
                                <select name="responsavel_id" id="responsavel_id" class="form-control select2 @error('responsavel_id') is-invalid @enderror">
                                    <option value="" selected disabled>--Selecione--</option>
                                    @foreach ($responsaveis as $responsavel)
                                        <option value="{{ $responsavel->id }}" {{ old('responsavel_id') == $responsavel->id ? 'selected' : '' }}>
                                            {{ $responsavel->nome }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('responsavel_id')
                                    <div class="invalid-feedback">{{ $message }}</div><br>
                                @enderror
                            </div>
                        </div>

                        {{-- Valor e Categoria --}}
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="valor" class="form-label fw-semibold text-uppercase small text-muted">Valor (R$)</label>
                                <div class="input-group">
                                    <span class="input-group-text">R$</span>
                                    <input type="text" class="form-control @error('valor') is-invalid @enderror"
                                        id="valor" name="valor" value="{{ old('valor') }}" placeholder="0,00">
                                    @error('valor') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                             <div class="col-md-4 mb-3">
                                <label for="data_vencimento" class="form-label fw-semibold text-uppercase small text-muted">Data de vencimento</label>
                                <input type="date" class="form-control @error('data_vencimento') is-invalid @enderror"
                                    id="data_vencimento" name="data_vencimento" value="{{ old('data_vencimento') }}">
                                @error('data_vencimento') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="dia_pagamento" class="form-label fw-semibold text-uppercase small text-muted">Dia de pagamento</label>
                                <input type="number" class="form-control @error('dia_pagamento') is-invalid @enderror"
                                    id="dia_pagamento" name="dia_pagamento" value="{{ old('dia_pagamento') }}" min="1" max="31" placeholder="Ex: 5" >
                                @error('dia_pagamento') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <hr>

                        {{-- Parcelamento --}}
                        <div class="mb-3">
                            <label class="form-label">Parcelamento</label>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="is_parcelado" name="is_parcelado" value="1" {{ old('is_parcelado') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_parcelado">É parcelado?</label>
                            </div>

                            <div id="campos-parcelamento" class="{{ old('is_parcelado') ? '' : 'd-none' }}">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="parcela_atual" class="form-label">Parcela atual</label>
                                        <input type="number" class="form-control @error('parcela_atual') is-invalid @enderror"
                                            id="parcela_atual" name="parcela_atual" value="{{ old('parcela_atual', 1) }}" min="1">
                                        @error('parcela_atual') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="total_parcelas" class="form-label">Total de parcelas</label>
                                        <input type="number" class="form-control @error('total_parcelas') is-invalid @enderror" id="total_parcelas"
                                            name="total_parcelas" value="{{ old('total_parcelas') }}" min="1">
                                        @error('total_parcelas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="valor_parcela" class="form-label">Valor por parcela</label>
                                        <div class="input-group">
                                            <span class="input-group-text">R$</span>
                                            <input type="text" class="form-control @error('valor_parcela') is-invalid @enderror" id="valor_parcela"
                                                name="valor_parcela" value="{{ old('valor_parcela') }}" placeholder="0,00">
                                            @error('valor_parcela') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Barra de progresso --}}
                                <div class="mb-3" id="progresso-parcela" style="display:none;">
                                    <label class="form-label">Progresso</label>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-primary" id="barra-progresso" role="progressbar" style="width: 0%"></div>
                                    </div>
                                    <small class="text-muted mt-1 d-block" id="texto-progresso"></small>
                                </div>
                            </div>
                        </div>

                        <hr>

                        {{-- Status e Recorrência --}}
                        <div class="mb-3">
                            <label class="form-label">Status e recorrência</label>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" id="is_pago" name="is_pago" value="1" {{ old('is_pago') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_pago">
                                    Já foi pago? <small class="text-muted">(marca como quitado)</small>
                                </label>
                            </div>

                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" id="is_fixo" name="is_fixo" value="1" {{ old('is_fixo') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_fixo">
                                    Lançamento fixo? <small class="text-muted">(repete todo mês automaticamente)</small>
                                </label>
                            </div>
                        </div>

                        {{-- Observação --}}
                        <div class="mb-3">
                            <label for="observacao" class="form-label">Observação <span class="text-muted fw-normal">(opcional)</span></label>
                            <textarea class="form-control" id="observacao" name="observacao"
                                rows="2" placeholder="Ex: Pago no dia 16, referente ao mês de abril...">{{ old('observacao') }}
                            </textarea>
                        </div>

                        {{-- Link de pagamento --}}
                        <div class="mb-4">
                            <label for="link_pagamento" class="form-label">Link de pagamento <span class="text-muted fw-normal">(opcional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i data-feather="link" style="width:14px;height:14px;"></i>
                                </span>
                                <input type="url" class="form-control" id="link_pagamento" name="link_pagamento"
                                    value="{{ old('link_pagamento') }}" placeholder="https://...">
                            </div>
                            <div class="form-text">Cole o link do site de pagamento (IPVA, boleto, etc.)</div>
                        </div>

                        {{-- Botões --}}
                        <div class="d-flex gap-2">
                            <button type="submit" class="button_submit btn btn-primary mr-2"><i class="fas fa-save"></i>&nbsp Salvar</button>
                            <a type="button" class="btn btn-secondary" href="{{ route('lancamento.index') }}"><i class="fas fa-redo"></i>&nbsp Cancelar</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>

        {{-- Sidebar direita --}}
        <div class="col-12 col-xl-4">

            {{-- Dicas --}}
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Dicas de preenchimento</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0 small">
                        <li class="d-flex gap-2 mb-2">
                            <span class="text-primary mt-1">●</span>
                            Use <strong>Casal</strong> para despesas compartilhadas entre Déborah e Wangley.
                        </li>
                        <li class="d-flex gap-2 mb-2">
                            <span class="text-success mt-1">●</span>
                            Ative <strong>Fixo</strong> para contas mensais recorrentes como aluguel e internet.
                        </li>
                        <li class="d-flex gap-2 mb-2">
                            <span class="text-warning mt-1">●</span>
                            Parcelamentos geram alertas automáticos a cada vencimento.
                        </li>
                        <li class="d-flex gap-2 mb-0">
                            <span class="text-info mt-1">●</span>
                            O link de pagamento abre diretamente o site da conta (IPVA, boleto, etc.).
                        </li>
                    </ul>
                </div>
            </div>

        </div>
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
