@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="login-wrapper">
    <div class="login-card">
        <div class="text-center mb-4">
            <div class="login-logo"><i class="bi bi-egg-fried"></i></div>
            <h4 class="mt-3 mb-0 fw-bold">Pak Resto UNIKOM</h4>
            <small class="text-muted">Sistem Informasi Restoran</small>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger py-2">
                <i class="bi bi-exclamation-triangle me-1"></i>{{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label small fw-semibold">Username</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-person"></i></span>
                    <input type="text" name="username" class="form-control" value="{{ old('username') }}" required autofocus placeholder="Masukkan username">
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label small fw-semibold">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control" required placeholder="Masukkan password">
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2">
                <i class="bi bi-box-arrow-in-right me-1"></i>Login
            </button>
        </form>
    </div>
</div>

<style>
    .login-wrapper {
        min-height: 85vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .login-card {
        background: #fff;
        width: 100%;
        max-width: 380px;
        padding: 40px 32px;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(29, 92, 138, 0.15);
    }
    .login-logo {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--brand-color) 0%, var(--brand-color-dark) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: var(--brand-accent);
        margin: 0 auto;
    }
    .login-card .input-group-text {
        border-right: none;
        color: var(--brand-color);
    }
    .login-card .form-control {
        border-left: none;
    }
    .login-card .form-control:focus {
        box-shadow: none;
        border-color: #ced4da;
    }
    .login-card .input-group:focus-within .input-group-text,
    .login-card .input-group:focus-within .form-control {
        border-color: var(--brand-color);
    }
    body {
        background: linear-gradient(160deg, #eaf3fa 0%, #d7e9f5 100%);
    }
</style>
@endsection
