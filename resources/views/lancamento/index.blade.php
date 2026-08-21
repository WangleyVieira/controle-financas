@extends('layout.main')

@section('content')
    @include('sweetalert::alert')

    <div class="card" style="background-color:white">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-0">Controle mensal</h4>
                <small class="text-muted">Histórico de receitas, despesas e pagamentos</small>
            </div>
            <a class="btn btn-success" href="{{ route('lancamento.create') }}">
                <i class="fas fa-plus-square"></i> Novo lançamento
            </a>
        </div>

        <div class="card-body">
            <form method="GET" class="row align-items-end mb-4">
                <div class="form-group col-md-4 mb-2">
                    <label for="competencia">Competência</label>
                    <select class="form-control" id="competencia" name="competencia">
                        @forelse ($competencias as $opcao)
                            <option value="{{ $opcao }}" {{ $competencia === $opcao ? 'selected' : '' }}>{{ $opcao }}</option>
                        @empty
                            <option value="{{ $competencia }}">{{ $competencia }}</option>
                        @endforelse
                    </select>
                </div>
                <div class="form-group col-md-3 mb-2">
                    <label for="situacao">Situação</label>
                    <select class="form-control" id="situacao" name="situacao">
                        <option value="">Todas</option>
                        @foreach (['pendente' => 'Pendente', 'parcial' => 'Parcial', 'pago' => 'Pago', 'vencido' => 'Vencido'] as $valor => $rotulo)
                            <option value="{{ $valor }}" {{ $situacao === $valor ? 'selected' : '' }}>{{ $rotulo }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-filter"></i> Filtrar</button>
                </div>
            </form>

            <div class="row mb-4">
                <div class="col-md-3 mb-2"><div class="card bg-light h-100"><div class="card-body py-3"><small>Receitas previstas</small><h5 class="mb-0 text-success">R$ {{ number_format($resumo['receitas'], 2, ',', '.') }}</h5></div></div></div>
                <div class="col-md-3 mb-2"><div class="card bg-light h-100"><div class="card-body py-3"><small>Despesas previstas</small><h5 class="mb-0 text-danger">R$ {{ number_format($resumo['despesas'], 2, ',', '.') }}</h5></div></div></div>
                <div class="col-md-3 mb-2"><div class="card bg-light h-100"><div class="card-body py-3"><small>Ainda pendente</small><h5 class="mb-0 text-warning">R$ {{ number_format($resumo['pendente'], 2, ',', '.') }}</h5></div></div></div>
                <div class="col-md-3 mb-2"><div class="card bg-light h-100"><div class="card-body py-3"><small>Saldo previsto</small><h5 class="mb-0 {{ $resumo['saldo'] < 0 ? 'text-danger' : 'text-success' }}">R$ {{ number_format($resumo['saldo'], 2, ',', '.') }}</h5></div></div></div>
            </div>

            @if ($lancamentos->isEmpty())
                <div class="alert alert-info text-center mb-0">Não há lançamentos para esta competência.</div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <thead style="background-color:#e2e7e6">
                            <tr>
                                <th>Venc.</th><th>Pago em</th><th>Descrição</th><th>Categoria</th><th>Tipo</th><th>Previsto</th><th>Pago</th><th>Situação</th><th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lancamentos as $lancamento)
                                @php($classesSituacao = ['pago' => 'success', 'parcial' => 'warning', 'pendente' => 'secondary', 'vencido' => 'danger'])
                                <tr>
                                    <td>{{ $lancamento->data_vencimento->format('d/m') }}</td>
                                    <td>{{ $lancamento->data_pagamento?->format('d/m/Y') ?? '-' }}</td>
                                    <td>{{ $lancamento->descricao }}</td>
                                    <td>{{ $lancamento->categoria?->descricao }}</td>
                                    <td>{{ ucfirst($lancamento->tipo) }}</td>
                                    <td>R$ {{ number_format($lancamento->valor, 2, ',', '.') }}</td>
                                    <td>{{ $lancamento->valor_pago !== null ? 'R$ ' . number_format($lancamento->valor_pago, 2, ',', '.') : '-' }}</td>
                                    <td><span class="badge badge-{{ $classesSituacao[$lancamento->situacao] }}">{{ ucfirst($lancamento->situacao) }}</span></td>
                                    <td class="text-nowrap">
                                        <a class="btn btn-warning btn-sm" href="{{ route('lancamento.edit', $lancamento->id) }}" title="Editar"><i class="fas fa-pen"></i></a>
                                        @if ($lancamento->is_fixo)
                                            <form class="d-inline" method="POST" action="{{ route('lancamento.gerar_proxima_competencia', $lancamento->id) }}">
                                                @csrf
                                                <button class="btn btn-primary btn-sm" type="submit" title="Gerar próxima competência"><i class="fas fa-calendar-plus"></i></button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
