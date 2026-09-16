@extends('layout.main')

@section('content')
    @include('sweetalert::alert')

    <div class="container-fluid p-0">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h1 class="h3 mb-1">Meu perfil</h1>
                <p class="text-muted mb-0">Atualize seus dados de acesso e sua senha.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 mb-3">
                <div class="card h-100">
                    <div class="card-body text-center d-flex flex-column justify-content-center">
                        <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 88px; height: 88px; font-size: 2rem;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <h4 class="mb-1">{{ $user->name }}</h4>
                        <p class="text-muted mb-0">{{ $user->email }}</p>
                        <small class="text-muted mt-3">Conta criada em {{ optional($user->created_at)->format('d/m/Y') }}</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header"><h5 class="card-title mb-0">Dados pessoais</h5></div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('perfil.update', $user->id) }}" class="form_prevent_multiple_submits">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <hr>
                            <button type="submit" class="button_submit btn btn-primary"><i class="fas fa-save"></i>&nbsp; Salvar alterações</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
