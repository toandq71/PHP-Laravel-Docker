@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">{{ __('admin.Create New Account') }}</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                @can('adminmanagement-index')
                    <a class="btn btn-success" href="{{ route('admin-management.index') }}"><i class="fa fa-angle-double-left"></i>{{ __('admin.Back To Admin List') }}</a>
                @endcan
                </div>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('admin-management.store') }}" class="create_account">
                @csrf
                <div class="card-body">        
                    <div class="tab-pane" id="settings">
                        <div class="form-horizontal">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label class="form-label">{{ __('admin.Name') }}</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" autocomplete="off" placeholder="{{ __('admin.Name') }}" required> 
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label class="form-label">{{ __('admin.Email') }}</label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" autocomplete="off" placeholder="{{ __('admin.Email') }}" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label class="form-label">{{ __('admin.Password') }}</label>
                                    <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" autocomplete="off" placeholder="{{ __('admin.Password') }}" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label class="form-label">{{ __('admin.Confirm Password') }}</label>
                                    <input type="password" class="form-control" id="confirm-password" name="confirm-password" value="{{ old('confirm-password') }}" autocomplete="off" placeholder="{{ __('admin.Confirm Password') }}" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label class="form-label">{{ __('admin.Roles') }}</label>
                                    <select class="roles-select2 form-select" multiple="multiple" data-width="100%" name="roles[]" required>
										<@foreach ($roles as $key => $role)
                                            <option value="{{ $role }}">{{ $role }}</option>
                                        @endforeach
									</select>
                                </div>
                            </div>
                        </div>
                    </div>        
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">{{ __('admin.Save') }}</button>        
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js_inline')
<script type="text/javascript">
    if ($(".roles-select2").length) {
        $(".roles-select2").select2();
    }
</script>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">{{ __('admin.Dashboard') }}</a></li>

    <li class="breadcrumb-item"><a href="#">{{ __('admin.Create New Account') }}</a></li>
</ol>
@endsection