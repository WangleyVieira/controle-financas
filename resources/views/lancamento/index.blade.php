@extends('layout.main')

@section('title', 'Novo Lançamento')

@section('content')
<div class="container-fluid p-0">

    {{-- Page Header --}}
    <div class="mb-3">
        <h1 class="h3 d-inline align-middle fw-bold">Lançamentos</h1>
        <nav aria-label="breadcrumb" class="d-inline ms-2">
            <ol class="breadcrumb d-inline-flex mb-0 p-0">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Lançamentos</a></li>
                <li class="breadcrumb-item active">Novo</li>
            </ol>
        </nav>
    </div>

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
                        <div class="mb-3">
                            <label for="descricao" class="form-label fw-semibold text-uppercase small text-muted">Descrição</label>
                            <input
                                type="text"
                                class="form-control @error('descricao') is-invalid @enderror"
                                id="descricao"
                                name="descricao"
                                value="{{ old('descricao') }}"
                                placeholder="Ex: Aluguel — Bairro Nova Campo Grande"
                                required
                            >
                            @error('descricao') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Valor e Categoria --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="valor" class="form-label fw-semibold text-uppercase small text-muted">Valor (R$)</label>
                                <div class="input-group">
                                    <span class="input-group-text">R$</span>
                                    <input type="text" class="form-control @error('valor') is-invalid @enderror"
                                        id="valor" name="valor" value="{{ old('valor') }}"
                                        placeholder="0,00" required
                                    >
                                    @error('valor') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Datas --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="data_vencimento" class="form-label fw-semibold text-uppercase small text-muted">Data de vencimento</label>
                                <input
                                    type="date"
                                    class="form-control @error('data_vencimento') is-invalid @enderror"
                                    id="data_vencimento"
                                    name="data_vencimento"
                                    value="{{ old('data_vencimento') }}"
                                    required
                                >
                                @error('data_vencimento') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="dia_pagamento" class="form-label fw-semibold text-uppercase small text-muted">Dia de pagamento</label>
                                <input
                                    type="number"
                                    class="form-control @error('dia_pagamento') is-invalid @enderror"
                                    id="dia_pagamento"
                                    name="dia_pagamento"
                                    value="{{ old('dia_pagamento') }}"
                                    min="1" max="31"
                                    placeholder="Ex: 5"
                                >
                                @error('dia_pagamento') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        {{-- Responsável --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-uppercase small text-muted">Responsável</label>
                            <div class="d-flex gap-2 flex-wrap">
                                <input type="radio" class="btn-check" name="responsavel" id="resp_deborah" value="deborah">
                                <label class="btn btn-outline-pink btn-sm rounded-pill" for="resp_deborah" style="border-color:#993556;color:#993556;">
                                    <i class="align-middle me-1" data-feather="user"></i> Déborah
                                </label>

                                <input type="radio" class="btn-check" name="responsavel" id="resp_wangley" value="wangley">
                                <label class="btn btn-outline-success btn-sm rounded-pill" for="resp_wangley">
                                    <i class="align-middle me-1" data-feather="user"></i> Wangley
                                </label>

                                <input type="radio" class="btn-check" name="responsavel" id="resp_casal" value="casal" checked>
                                <label class="btn btn-outline-primary btn-sm rounded-pill" for="resp_casal">
                                    <i class="align-middle me-1" data-feather="users"></i> Casal
                                </label>
                            </div>
                            @error('responsavel') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <hr>

                        {{-- Parcelamento --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-uppercase small text-muted">Parcelamento</label>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="is_parcelado" name="is_parcelado" value="1" {{ old('is_parcelado') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_parcelado">É parcelado?</label>
                            </div>

                            <div id="campos-parcelamento" class="{{ old('is_parcelado') ? '' : 'd-none' }}">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="parcela_atual" class="form-label fw-semibold text-uppercase small text-muted">Parcela atual</label>
                                        <input
                                            type="number"
                                            class="form-control @error('parcela_atual') is-invalid @enderror"
                                            id="parcela_atual"
                                            name="parcela_atual"
                                            value="{{ old('parcela_atual', 1) }}"
                                            min="1"
                                        >
                                        @error('parcela_atual') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="total_parcelas" class="form-label fw-semibold text-uppercase small text-muted">Total de parcelas</label>
                                        <input
                                            type="number"
                                            class="form-control @error('total_parcelas') is-invalid @enderror"
                                            id="total_parcelas"
                                            name="total_parcelas"
                                            value="{{ old('total_parcelas') }}"
                                            min="1"
                                        >
                                        @error('total_parcelas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="valor_parcela" class="form-label fw-semibold text-uppercase small text-muted">Valor por parcela</label>
                                        <div class="input-group">
                                            <span class="input-group-text">R$</span>
                                            <input
                                                type="text"
                                                class="form-control @error('valor_parcela') is-invalid @enderror"
                                                id="valor_parcela"
                                                name="valor_parcela"
                                                value="{{ old('valor_parcela') }}"
                                                placeholder="0,00"
                                            >
                                            @error('valor_parcela') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Barra de progresso --}}
                                <div class="mb-3" id="progresso-parcela" style="display:none;">
                                    <label class="form-label fw-semibold text-uppercase small text-muted">Progresso</label>
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
                            <label class="form-label fw-semibold text-uppercase small text-muted">Status e recorrência</label>

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
                            <label for="observacao" class="form-label fw-semibold text-uppercase small text-muted">Observação <span class="text-muted fw-normal">(opcional)</span></label>
                            <textarea
                                class="form-control"
                                id="observacao"
                                name="observacao"
                                rows="2"
                                placeholder="Ex: Pago no dia 16, referente ao mês de abril..."
                            >{{ old('observacao') }}</textarea>
                        </div>

                        {{-- Link de pagamento --}}
                        <div class="mb-4">
                            <label for="link_pagamento" class="form-label fw-semibold text-uppercase small text-muted">Link de pagamento <span class="text-muted fw-normal">(opcional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i data-feather="link" style="width:14px;height:14px;"></i>
                                </span>
                                <input
                                    type="url"
                                    class="form-control"
                                    id="link_pagamento"
                                    name="link_pagamento"
                                    value="{{ old('link_pagamento') }}"
                                    placeholder="https://..."
                                >
                            </div>
                            <div class="form-text">Cole o link do site de pagamento (IPVA, boleto, etc.)</div>
                        </div>

                        {{-- Botões --}}
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i data-feather="save" class="align-middle me-1" style="width:16px;height:16px;"></i>
                                Salvar lançamento
                            </button>
                            <a href="#" class="btn btn-outline-secondary">
                                Cancelar
                            </a>
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

            {{-- Ações rápidas --}}
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Ações rápidas</h5>
                </div>
                <div class="card-body d-grid gap-2">
                    <a href="#" class="btn btn-outline-secondary btn-sm text-start">
                        <i data-feather="list" class="align-middle me-2" style="width:14px;height:14px;"></i>
                        Ver todos os lançamentos
                    </a>
                    <a href="#" class="btn btn-outline-success btn-sm text-start">
                        <i data-feather="plus-circle" class="align-middle me-2" style="width:14px;height:14px;"></i>
                        Cadastrar entrada / salário
                    </a>
                    <a href="#" class="btn btn-outline-primary btn-sm text-start">
                        <i data-feather="credit-card" class="align-middle me-2" style="width:14px;height:14px;"></i>
                        Gerenciar cartões de crédito
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {

        // Toggle campos de parcelamento
        const isParcelado = document.getElementById('is_parcelado');
        const camposParcelamento = document.getElementById('campos-parcelamento');

        isParcelado.addEventListener('change', function () {
            camposParcelamento.classList.toggle('d-none', !this.checked);
            atualizarProgresso();
        });

        // Barra de progresso do parcelamento
        const parcelaAtual = document.getElementById('parcela_atual');
        const totalParcelas = document.getElementById('total_parcelas');
        const progressoDiv = document.getElementById('progresso-parcela');
        const barraProgresso = document.getElementById('barra-progresso');
        const textoProgresso = document.getElementById('texto-progresso');
        const valorParcela = document.getElementById('valor_parcela');

        function atualizarProgresso() {
            const atual = parseInt(parcelaAtual.value) || 0;
            const total = parseInt(totalParcelas.value) || 0;
            const valor = valorParcela.value || '0';

            if (isParcelado.checked && atual > 0 && total > 0) {
                const pct = Math.min((atual / total) * 100, 100).toFixed(0);
                const faltam = total - atual;
                progressoDiv.style.display = 'block';
                barraProgresso.style.width = pct + '%';
                textoProgresso.textContent = `Parcela ${atual} de ${total} — faltam ${faltam}x de R$ ${valor}`;
            } else {
                progressoDiv.style.display = 'none';
            }
        }

        parcelaAtual.addEventListener('input', atualizarProgresso);
        totalParcelas.addEventListener('input', atualizarProgresso);
        valorParcela.addEventListener('input', atualizarProgresso);

        // Pré-visualização em tempo real
        const descricaoInput = document.getElementById('descricao');
        const valorInput = document.getElementById('valor');
        const vencimentoInput = document.getElementById('data_vencimento');
        const categoriaSelect = document.getElementById('categoria_id');
        const isPago = document.getElementById('is_pago');

        function atualizarPreview() {
            document.getElementById('prev-descricao').textContent = descricaoInput.value || '—';
            document.getElementById('prev-valor').textContent = valorInput.value ? 'R$ ' + valorInput.value : '—';

            if (vencimentoInput.value) {
                const d = new Date(vencimentoInput.value + 'T00:00:00');
                document.getElementById('prev-vencimento').textContent = d.toLocaleDateString('pt-BR');
            } else {
                document.getElementById('prev-vencimento').textContent = '—';
            }

            const catOpt = categoriaSelect.options[categoriaSelect.selectedIndex];
            document.getElementById('prev-categoria').textContent = catOpt.value ? catOpt.text : '—';

            const statusEl = document.getElementById('prev-status');
            statusEl.innerHTML = isPago.checked
                ? '<span class="badge bg-success">Pago</span>'
                : '<span class="badge bg-warning text-dark">Pendente</span>';
        }

        function atualizarResponsavel() {
            const selecionado = document.querySelector('input[name="responsavel"]:checked');
            const mapa = { deborah: 'Déborah', wangley: 'Wangley', casal: 'Casal' };
            document.getElementById('prev-responsavel').textContent = selecionado ? mapa[selecionado.value] : '—';
        }

        descricaoInput.addEventListener('input', atualizarPreview);
        valorInput.addEventListener('input', atualizarPreview);
        vencimentoInput.addEventListener('change', atualizarPreview);
        categoriaSelect.addEventListener('change', atualizarPreview);
        isPago.addEventListener('change', atualizarPreview);
        document.querySelectorAll('input[name="responsavel"]').forEach(r => r.addEventListener('change', atualizarResponsavel));

        // Máscara simples de valor monetário
        valorInput.addEventListener('blur', function () {
            let v = this.value.replace(/\D/g, '');
            if (v) {
                v = (parseInt(v) / 100).toFixed(2);
                this.value = v.replace('.', ',');
            }
        });

        valorParcela.addEventListener('blur', function () {
            let v = this.value.replace(/\D/g, '');
            if (v) {
                v = (parseInt(v) / 100).toFixed(2);
                this.value = v.replace('.', ',');
            }
        });

    });
    </script>
@endsection
