@extends('layout.main')

@section('content')
    @include('sweetalert::alert')

    <div class="container-fluid p-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1"><strong>Dashboard</strong> financeiro</h1>
                <span class="text-muted">Visão geral de todos os cadastros</span>
            </div>
            <a href="{{ route('lancamento.create') }}" class="btn btn-success">
                <i class="fas fa-plus-square"></i> Novo lançamento
            </a>
        </div>

        <div class="row mb-4">
            @php
                $cards = [
                    ['label' => 'Despesas totais', 'value' => $resumo['despesas'], 'color' => 'danger', 'icon' => 'fa-arrow-down'],
                    ['label' => 'Pendente total', 'value' => $resumo['pendente'], 'color' => 'warning', 'icon' => 'fa-clock'],
                    ['label' => 'Saldo total', 'value' => $resumo['saldo'], 'color' => $resumo['saldo'] < 0 ? 'danger' : 'success', 'icon' => 'fa-wallet'],
                    ['label' => 'Salários totais', 'value' => $resumo['salario'], 'color' => 'primary', 'icon' => 'fa-money-bill-wave'],
                ];
            @endphp
            @foreach ($cards as $card)
                <div class="col-12 col-sm-6 col-xl-3 mb-3">
                    <div class="card border-0 shadow-sm h-100" style="border-radius: 18px;">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <small class="text-muted">{{ $card['label'] }}</small>
                                <span class="text-{{ $card['color'] }}"><i class="fas {{ $card['icon'] }}"></i></span>
                            </div>
                            <h3 class="mb-0 text-{{ $card['color'] }}">R$ {{ number_format((float) $card['value'], 2, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-xl-8 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Despesas por categoria</h5>
                        <span class="text-muted small">Todos os cadastros ({{ $totalLancamentosCategorias }} lançamentos)</span>
                    </div>
                    <div class="card-body">
                        @if ($categorias->isEmpty())
                            <p class="text-muted text-center py-5 mb-0">Ainda não há despesas cadastradas.</p>
                        @else
                            <div style="height: 280px;"><canvas id="graficoCategorias"></canvas></div>
                            <div class="table-responsive mt-3">
                                <table class="table table-sm mb-0">
                                    <thead>
                                        <tr>
                                            <th>Categoria</th>
                                            <th class="text-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categorias as $categoria => $total)
                                            <tr>
                                                <td>{{ $categoria }}</td>
                                                <td class="text-right font-weight-bold">R$ {{ number_format((float) $total, 2, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-4 mb-4">
                <div class="card h-100">
                    <div class="card-header"><h5 class="card-title mb-0">Comparativo de despesas</h5></div>
                    <div class="card-body d-flex flex-column justify-content-center">
                        <div style="height: 280px;"><canvas id="graficoComparativo"></canvas></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Lançamentos recentes</h5>
                <a href="{{ route('lancamento.index') }}" class="btn btn-sm btn-outline-primary">Ver todos</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background-color:#e2e7e6">
                        <tr><th>Descrição</th><th>Categoria</th><th>Vencimento</th><th>Valor</th><th>Situação</th></tr>
                    </thead>
                    <tbody>
                        @forelse ($lancamentosRecentes as $lancamento)
                            @php($classesSituacao = ['pago' => 'success', 'pendente' => 'secondary', 'vencido' => 'danger'])
                            <tr>
                                <td>{{ $lancamento->descricao }}</td>
                                <td>{{ $lancamento->categoria?->descricao ?? '-' }}</td>
                                <td>{{ $lancamento->data_vencimento?->format('d/m/Y') ?? '-' }}</td>
                                <td>R$ {{ number_format((float) $lancamento->valor, 2, ',', '.') }}</td>
                                <td><span class="badge badge-{{ $classesSituacao[$lancamento->situacao] }}">{{ ucfirst($lancamento->situacao) }}</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center text-muted py-4">Nenhum lançamento cadastrado.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <script>
        $(function () {
            var categoriaCanvas = document.getElementById('graficoCategorias');
            if (categoriaCanvas) {
                new Chart(categoriaCanvas, {
                    type: 'pie',
                    data: {
                        labels: @json($categorias->keys()->values()),
                        datasets: [{
                            data: @json($categorias->values()->values()),
                            backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#06b6d4'],
                            borderWidth: 0
                        }]
                    },
                    options: { maintainAspectRatio: false, legend: { position: 'bottom' } }
                });
            }

            new Chart(document.getElementById('graficoComparativo'), {
                type: 'bar',
                data: {
                    labels: ['Despesas pagas', 'Despesas pendentes'],
                    datasets: [{
                        data: [{{ $comparativo['pago'] }}, {{ $comparativo['pendente'] }}],
                        backgroundColor: ['#10b981', '#f59e0b'],
                        borderWidth: 0
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: { display: false },
                    scales: { yAxes: [{ ticks: { beginAtZero: true } }] }
                }
            });
        });
    </script>
@endsection
