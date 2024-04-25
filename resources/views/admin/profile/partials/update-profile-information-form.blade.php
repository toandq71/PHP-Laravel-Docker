<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h6 class="card-title">{{ __('admin.Profile Information') }}</h6>
            @can('profile-update')
            <form class="forms-sample" method="post" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')
            @endcan
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('admin.Username') }}</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" autocomplete="off" placeholder="{{ __('admin.Username') }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('admin.Email') }}</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="{{ __('admin.Email') }}" required>
                </div>
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                            {{ __('admin.Your email address is unverified.') }}
                            <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                {{ __('admin.Click here to re-send the verification email.') }}
                            </button>
                        </p>
                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ __('admin.A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
                @can('profile-update')
                <button type="submit" class="btn btn-primary me-2">{{ __('admin.Save') }}</button>
            </form>
            @endcan
        </div>
    </div>
</div>