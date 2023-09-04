@extends('layouts.auth')

@section('content')
    <!-- Login -->
    <div class="card p-2">
        <!-- Logo -->
        <div class="app-brand justify-content-center mt-5">
            <a href="index.html" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                    <span style="color:#9055FD;">
                        <img src="{{ asset('assets/img/purnama.png') }}" alt="" height="120" width="120">
                    </span>
                </span>
            </a>
        </div>
        <!-- /Logo -->

        <div class="card-body mt-2">
            <h4 class="mb-2">Selamat datang admin! 👋</h4>
            <p class="mb-4">Mohon Login Ke Akun</p>

            <form id="formAuthentication" class="mb-3" action="{{ route('do-login') }}" method="POST">
                @csrf
                <div class="form-floating form-floating-outline mb-3">
                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email or username" autofocus>
                    <label for="email">Email or Username</label>
                </div>
                <div class="mb-3">
                    <div class="form-password-toggle">
                        <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                            <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                            <label for="password">Password</label>
                        </div>
                        <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                        </div>
                    </div>
                </div>
                <div class="mb-3 d-flex justify-content-between">
                    <a href="{{ route('form-register') }}" class="float-end mb-1">
                        <span>Belom Punya Akun ?</span>
                    </a>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /Login -->
@endsection
