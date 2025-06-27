<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ __('admins.admin_login') }}</title>

    @if(isset($settings->favicon) && file_exists(public_path($settings->favicon)))
    <link href="{{ asset($settings->favicon) }}" rel="icon">
    <link href="{{ asset($settings->favicon) }}" rel="apple-touch-icon">
    @else
    <link href="{{ asset('assets/img/favicons/favicon.ico') }}" rel="icon">
    <link href="{{ asset('assets/img/favicons/favicon.ico') }}" rel="apple-touch-icon">
    @endif

    <!-- Bootstrap CSS -->
    @if(app()->getLocale() === 'ar')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" />
    @else
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    @endif

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Admin CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}" />

</head>

<body class="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    <!-- زر تبديل اللغة -->
    <div class="language-switcher">
        <a href="{{ route('lang.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}"
            class="btn btn-outline-brown btn-sm"
            style="font-family: {{ app()->getLocale() === 'ar' ? 'var(--english-font)' : 'var(--arabic-font)' }}">
            <i class="fas fa-language"></i>
            {{ app()->getLocale() === 'ar' ? 'English' : 'العربية' }}
        </a>
    </div>

    <div class="text-center mb-4">
        <p class="sitename"
            style="font-family: {{ app()->getLocale() === 'ar' ? 'var(--arabic-font)' : 'var(--english-font)' }};">
            {{__('admins.welcome')}}</p>
    </div>

    {{-- نموذج تسجيل الدخول --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7 col-sm-10 col-12">
                <div class="login-container">
                    <div class="login-header">
                        <h1
                            style="font-family: {{ app()->getLocale() === 'ar' ? 'var(--arabic-font)' : 'var(--english-font)' }};">
                            {{ __('admins.admin_login') }}</h1>
                    </div>

                    <form method="POST" action="{{ route('admin.login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label fw-medium"
                                style="font-family: {{ app()->getLocale() === 'ar' ? 'var(--arabic-font)' : 'var(--english-font)' }};">{{
                                __('admins.email_address') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" value="{{ old('email') }}" required autofocus
                                    placeholder="{{__('admins.enter_your_email')}}"
                                    style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }}; font-family: {{ app()->getLocale() === 'ar' ? 'var(--arabic-font)' : 'var(--english-font)' }};" />
                            </div>
                            @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label fw-medium"
                                style="font-family: {{ app()->getLocale() === 'ar' ? 'var(--arabic-font)' : 'var(--english-font)' }};">{{
                                __('admins.password') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" required
                                    placeholder="{{__('admins.enter_your_password')}}"
                                    style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }}; font-family: {{ app()->getLocale() === 'ar' ? 'var(--arabic-font)' : 'var(--english-font)' }};" />
                            </div>
                            @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember" {{
                                    old('remember') ? 'checked' : '' }} />
                                <label class="form-check-label" for="remember"
                                    style="font-family: {{ app()->getLocale() === 'ar' ? 'var(--arabic-font)' : 'var(--english-font)' }};">{{
                                    __('admins.remember_me') }}</label>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn custom-login-btn"
                                style="font-family: {{ app()->getLocale() === 'ar' ? 'var(--arabic-font)' : 'var(--english-font)' }}">
                                <i class="fas fa-sign-in-alt me-2"></i>{{ __('admins.login') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
