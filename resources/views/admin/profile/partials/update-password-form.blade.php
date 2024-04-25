@can('profile-update')
<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h6 class="card-title">{{ __('admin.Update Password') }}</h6>
            <form class="forms-sample"  method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')
                <div class="row mb-3">
                    <label for="update_password_current_password" class="col-sm-3 col-form-label">{{ __('admin.Current Password') }}</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="update_password_current_password" name="current_password" placeholder="{{ __('admin.Current Password') }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="update_password_password" class="col-sm-3 col-form-label">{{ __('admin.New Password') }}</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="update_password_password" name="password" placeholder="{{ __('admin.New Password') }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="update_password_password_confirmation" class="col-sm-3 col-form-label">{{ __('admin.Confirm Password') }}</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="update_password_password_confirmation" name="password_confirmation" placeholder="{{ __('admin.Confirm Password') }}" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary me-2">{{ __('admin.Save') }}</button>
            </form>
        </div>
    </div>
</div>
@endcan