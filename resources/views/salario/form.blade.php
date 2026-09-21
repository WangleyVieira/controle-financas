@extends('layout.main')

@section('content')
    @include('sweetalert::alert')

    @php
        $isEdit = isset($entradaSalario);
        $titulo = $isEdit ? 'Editar entrada de salário' : 'Novo salário';
        $action = $isEdit ? route('entrada_salario.update', $entradaSalario->id) : route('entrada_salario.store');
    @endphp

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12 col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $titulo }}</h4>
                        <hr>
                    </div>
                    <div class="card-body">
                        <form action="{{ $action }}" method="POST">
                            @csrf
                            @if ($isEdit)
                                @method('PUT')
                            @endif

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="competencia" class="form-label">Competência (MM/AAAA)</label>
                                    <input type="text" class="form-control competencia-mask @error('competencia') is-invalid @enderror"
                                        id="competencia" name="competencia"
                                        value="{{ old('competencia', $entradaSalario->competencia ?? now()->format('m/Y')) }}"
                                        placeholder="05/2026">
                                    @error('competencia')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="valor_salario" class="form-label">Valor do salário</label>
                                    <div class="input-group">
                                        <span class="input-group-text">R$</span>
                                        <input type="text" class="form-control valor @error('valor_salario') is-invalid @enderror"
                                            id="valor_salario" name="valor_salario"
                                            value="{{ old('valor_salario', $entradaSalario->valor_salario ?? null) }}"
                                            placeholder="0,00">
                                        @error('valor_salario')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <label for="descricao" class="form-label">Descrição</label>
                                <input type="text" class="form-control @error('descricao') is-invalid @enderror"
                                    id="descricao" name="descricao"
                                    value="{{ old('descricao', $entradaSalario->descricao ?? null) }}"
                                    placeholder="Ex: Salário mensal - empresa">
                                @error('descricao')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('entrada_salario.index') }}" class="btn btn-secondary">Voltar</a>
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('.competencia-mask').mask('00/0000');
            $('.valor').mask('#.##0,00', { reverse: true });
        });
    </script>
@endsection
