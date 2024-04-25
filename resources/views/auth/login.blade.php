@extends('layouts.admin.default_login')

@section('title')
    Administrator Login
@endsection

@section('content')

    <div class="page-wrapper full-page">
        <div class="page-content d-flex align-items-center justify-content-center">

            <div class="row w-100 mx-0 auth-page">
                <div class="col-md-8 col-xl-6 mx-auto">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-4 pe-md-0">
                                <div class="auth-side-wrapper">

                                </div>
                            </div>
                            <div class="col-md-8 ps-md-0">
                                <div class="auth-form-wrapper px-4 py-5">
                                    <a href="#" class="noble-ui-logo d-block mb-2">{{ config('admin.name', 'Administrator') }}</a>
                                    <h5 class="text-muted fw-normal mb-4">{{ trans('auth.slug_admin_login') }}</h5>

                                    @if ($errors->any())
                                        @foreach ($errors->all() as $error)
                                            <div class="alert alert-danger">
                                                <i class="mdi mdi-alert"></i>{{ $error }}
                                            </div>
                                        @endforeach
                                    @endif

                                    <form class="forms-sample" role="form" action="{{ route('login') }}" method="POST">
                                        {{ csrf_field() }}
                                        <div class="mb-3">
                                            <label for="email" class="form-label">{{ trans('auth.your_email') }}</label>
                                            <input type="text" 
                                                    class="form-control {{ isset($errors) && $errors->has('email') ? ' is-invalid' : '' }}" 
                                                    id="email" 
                                                    name="email" 
                                                    placeholder="{{ trans('auth.your_email') }}" 
                                                    value="{{ old('email') }}" required>
                                        </div>
                                        <div class="mb-3 own-icon-inside-right">
                                            <label for="password" class="form-label">{{ trans('auth.password')}}</label>
                                            <span aria-hidden="true" id="eye">
                                                <i class="mdi mdi-eye-off"></i>
                                            </span>
                                            <input type="password" 
                                                    class="form-control {{ isset($errors) && $errors->has('password') ? ' is-invalid' : '' }}" 
                                                    id="password" 
                                                    name="password" 
                                                    placeholder="{{ trans('auth.password') }}" required>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input type="checkbox" class="form-check-input" id="authCheck">
                                            <label class="form-check-label" for="authCheck">
                                                {{ trans('auth.remember_me') }}
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            @if (Route::has('password.request'))
                                                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                                    {{ trans('auth.forgot_your_password') }}
                                                </a>
                                            @endif
                                        </div>
                                        <div>
                                            <input class="btn btn-primary me-2 mb-2 mb-md-0 text-white" type="submit" value="{{ trans('auth.login') }}">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .own-icon-inside-right {
            position: relative;
        }
        .own-icon-inside-right span {
            position: absolute;
            right: 15px;
            bottom: 10px;
        }
        span#eye i {
            color: #81839c;
        }
    </style>


@endsection
