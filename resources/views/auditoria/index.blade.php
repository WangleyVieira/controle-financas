@extends('layout.main')

@section('content')
    @include('sweetalert::alert')

    @php
        $labels = [
            'created' => 'Criado',
            'updated' => 'Atualizado',
            'deleted' => 'Excluído',
            'login' => 'Login',
            'login_failed' => 'Falha no login',
            'logout' => 'Logout',
        ];
        $types = [
            'App\\Models\\Lancamento' => 'Lançamento',
            'App\\Models\\EntradaSalario' => 'Salário',
            'App\\Models\\Categoria' => 'Categoria',
            'App\\Models\\User' => 'Usuário',
            'auth' => 'Autenticação',
        ];
        $formatValues = function (?array $values): string {
            if (empty($values)) {
                return '-';
            }

            return collect($values)->map(function ($value, $key) {
                $label = ucfirst(str_replace('_', ' ', $key));

                if (is_array($value)) {
                    $value = json_encode($value, JSON_UNESCAPED_UNICODE);
                } elseif (is_bool($value)) {
                    $value = $value ? 'Sim' : 'Não';
                } elseif ($value === null || $value === '') {
                    $value = '-';
                }

                return "{$label}: {$value}";
            })->implode(' | ');
        };
    @endphp

    <div class="card" style="background-color:white">
        <div class="card-header">
            <h4>Auditoria do sistema</h4>
            <small class="text-muted">Registro das alterações e ações de autenticação do sistema.</small>
            <hr>
        </div>
        <div class="card-body">
            <form method="GET" class="row align-items-end mb-4">
                <div class="form-group col-md-3 mb-2">
                    <label for="action">Ação</label>
                    <select class="form-control" id="action" name="action">
                        <option value="">Todas</option>
                        @foreach ($labels as $value => $label)
                            <option value="{{ $value }}" {{ $action === $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3 mb-2">
                    <label for="auditable_type">Módulo</label>
                    <select class="form-control" id="auditable_type" name="auditable_type">
                        <option value="">Todos</option>
                        @foreach ($types as $value => $label)
                            <option value="{{ $value }}" {{ $auditableType === $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-filter"></i> Filtrar</button>
                </div>
            </form>

            @if ($audits->isEmpty())
                <h1 class="alert-info px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Não há registros na auditoria.</h1>
            @else
                <div class="table-responsive">
                    <table id="datatable-auditoria" class="table table-bordered table-hover" style="width: 100%;">
                        <thead style="background-color:#e2e7e6">
                            <tr>
                                <th>Data</th>
                                <th>Usuário</th>
                                <th>Ação</th>
                                <th>Módulo</th>
                                <th>Detalhes</th>
                                <th>IP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($audits as $audit)
                                <tr>
                                    <td data-order="{{ $audit->created_at->timestamp }}">{{ $audit->created_at->format('d/m/Y H:i:s') }}</td>
                                    <td>{{ $audit->usuario?->name ?? 'Sistema / não autenticado' }}</td>
                                    <td>{{ $labels[$audit->action] ?? ucfirst($audit->action) }}</td>
                                    <td>{{ $types[$audit->auditable_type] ?? class_basename($audit->auditable_type) }}</td>
                                    <td>
                                        @if ($audit->old_values)
                                            <strong>Antes:</strong> {{ $formatValues($audit->old_values) }}<br>
                                        @endif
                                        @if ($audit->new_values)
                                            <strong>Depois:</strong> {{ $formatValues($audit->new_values) }}
                                        @endif
                                        @if (!$audit->old_values && !$audit->new_values)
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $audit->ip_address ?? '-' }}</td>
                                </tr>
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
        $(document).ready(function () {
            $('#datatable-auditoria').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json'
                },
                responsive: true,
                order: [[0, 'desc']]
            });
        });
    </script>
@endsection
