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
            class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-language"></i>
            {{ app()->getLocale() === 'ar' ? 'English' : 'العربية' }}
        </a>
    </div>
    <div class="text-center mb-4">
        <div class="logo d-flex align-items-center justify-content-center gap-2">
            {{-- عرض الشعار مع صورة افتراضية في حال عدم وجوده --}}
            @if(isset($settings->logo) && file_exists(public_path($settings->logo)))
            <img src="{{ asset($settings->logo) }}" alt="Logo" style="width: 80px; height: auto;">
            @else
            <img src="{{ asset('assets/img/logos/web-app-manifest-512x512.png') }}" alt="Default Logo"
                style="width: 80px; height: auto;">
            @endif
        </div>
        <div class="mt-2">
            <a href="" class="text-decoration-none">
                <h1 class="sitename" style="font-size: 1.5rem;">
                    @if(app()->getLocale() == 'ar')
                    {{ $heroPage?->title_ar ?? 'حد الشباك' }}
                    @else
                    {{ $heroPage?->title_en ?? 'Had AlShebak' }}
                    @endif
                </h1>
            </a>
        </div>
    </div>

    {{-- نموذج تسجيل الدخول --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7 col-sm-10 col-12">
                <div class="login-container">
                    <div class="login-header">
                        <h1>{{ __('admins.admin_login') }}</h1>
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('admin.login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('admins.email_address') }}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email') }}" required autofocus />
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('admins.password') }}</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" required />
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember" {{
                                old('remember') ? 'checked' : '' }} />
                            <label class="form-check-label" for="remember">{{ __('admins.remember_me') }}</label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn custom-login-btn">{{ __('admins.login') }}</button>
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
