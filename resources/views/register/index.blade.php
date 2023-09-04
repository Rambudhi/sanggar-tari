@extends('layouts.auth')

@section('content')
    <!-- Register Card -->
    <div class="card p-2">
        <!-- Logo -->
        <div class="app-brand justify-content-center mt-5">
            <a href="" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                    <span style="color:var(--bs-primary);">
                        <img src="{{ asset('assets/img/purnama.png') }}" alt="" height="120" width="120">
                    </span>
                </span>
            </a>
        </div>
        <!-- /Logo -->
        <div class="card-body mt-2">
            <h4 class="mb-2">Dimulai Dari sini 🚀</h4>
            <p class="mb-4">Buat akun anda !</p>

            <form id="formAuthentication" class="mb-3" action="{{ route('do-register') }}" method="POST">
                @csrf
                <div class="form-floating form-floating-outline mb-3">
                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" autocomplete="off">
                    <label for="email">Email</label>
                </div>
                <div class="mb-3 form-password-toggle">
                    <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                        <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" autocomplete="new-password"/>
                        <label for="password">Password</label>
                        </div>
                        <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                    </div>
                </div>
                <div class="mb-3 form-password-toggle">
                    <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                            <input type="password" id="password-confirm" class="form-control" name="password_confirm" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password-confirm" autocomplete="new-password"/>
                            <label for="password-confirm">Password Confirm</label>
                        </div>
                        <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms">
                        <label class="form-check-label" for="terms-conditions">
                            Saya Setuju
                            <a href="javascript:void(0);">Saya setuju dengan kebijakan dan privasi</a>
                        </label>
                    </div>
                </div>
                <button class="btn btn-primary d-grid w-100" type="submit">
                    Daftar
                </button>
            </form>

            <p class="text-center">
                <span>Sudah Punya Akun ?</span>
                <a href="auth-login-basic.html">
                    <span>Masuk saja</span>
                </a>
            </p>
        </div>
    </div>
    <!-- Register Card -->
@endsection
