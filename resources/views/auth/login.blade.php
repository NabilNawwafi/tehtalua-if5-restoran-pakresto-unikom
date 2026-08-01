@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h4 class="card-title text-center mb-4">Login Pegawai</h4>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" value="{{ old('username') }}" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection