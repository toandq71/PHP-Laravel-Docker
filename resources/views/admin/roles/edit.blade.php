@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">{{ __('admin.Edit Role') }} - {{ $role->name }}</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                @can('rolemanagement-index')
                    <a class="btn btn-success" href="{{ route('role-management.index') }}"><i class="fas fa-angle-double-left"></i>{{ __('admin.Back To Role List') }}</a>
                @endcan
                </div>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('role-management.update', $role->id) }}" class="update_roles">
                @csrf
                <div class="card-body">
                    <div class="tab-pane" id="settings">
                        <div class="form-horizontal">
                            <div class="form-group row">
                                <label for="inputName" class="col-md-2 col-form-label">{{ __('admin.Name') }}</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" id="name" name="name" autocomplete="off" value="{{ $role->name }}" placeholder="{{ __('admin.Name') }}" required> 
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <h6 class="card-title">{{ __('admin.Permissions') }}</h6>
                                </div>
                                <div class="col-md-10">
                                    <input type="checkbox" class="check_all_permissions form-check-input" /> <strong>{{ __('admin.Check All') }}</strong>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="row">
                                        @if (isset($permission))
                                            @foreach($permission as $guardName => $listPermissions)
                                                <div class="col-lg-12">
                                                    <h6 class="card-title color-main">Guard: {{ $guardName }}</h6>
                                                </div>

                                                @php
                                                    $strCont = "";
                                                    $len = count($listPermissions);  
                                                @endphp

                                                @if (isset($listPermissions))
                                                    @foreach($listPermissions as $indexKey => $itemPermission)

                                                        @if($indexKey === 0)
                                                            <div class="col-lg-12 list-permision">
                                                        @endif

                                                        @if ($strCont != substr($itemPermission->name, 0, strpos($itemPermission->name,"-")) && $indexKey === 0)
                                                            @php $strCont = substr($itemPermission->name, 0, strpos($itemPermission->name,"-")); @endphp
                                                            <label class="nameCont">{{ $strCont }}<input type="checkbox" rel="{{ $strCont }}" class="check_permissions_by_cont form-check-input" /></label>
                                                            <div class="block">
                                                        @elseif ($strCont != substr($itemPermission->name, 0, strpos($itemPermission->name,"-")) && $indexKey !== 0)
                                                                @php $strCont = substr($itemPermission->name, 0, strpos($itemPermission->name,"-")); @endphp
                                                                </div></div><div class="col-lg-12 list-permision">
                                                                <label class="nameCont">{{ $strCont }}<input type="checkbox" rel="{{ $strCont }}" class="check_permissions_by_cont form-check-input" /></label><div class="block">
                                                        @endif

                                                        <div class="col-md-12">
                                                            <input type="checkbox" {{ in_array($itemPermission->id, $rolePermissions) ? 'checked' : '' }} class="form-check-input check-permissions check-per-{{ $strCont }}" id="permission" name="permission[]" value="{{ $itemPermission->name }}"/>
                                                            <label for="">{{ $itemPermission->name }}</label>
                                                        </div>

                                                        @if($indexKey === $len-1)
                                                            </div></div>
                                                        @endif
                                                        
                                                    @endforeach
                                                @endif

                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.card-body -->
                @can('rolemanagement-update')
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">{{ __('admin.Save') }}</button>        
                </div>
                @endcan
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection

@section('js_inline')
<script type="text/javascript">
    $(".check_all_permissions").change(function () {
        $("input.check-permissions").prop('checked', $(this).prop("checked"));
        $("input.check_permissions_by_cont").prop('checked', $(this).prop("checked"));
    });
    $(".check_permissions_by_cont").change(function () {
        var rel = $(this).attr('rel');
        $("input.check-per-" + rel).prop('checked', $(this).prop("checked"));
    });
    $('form.update_roles').submit(function () {
        if ($('input.check-permissions:checked').length < 1){
            showNotification('error', 'Please select at least one option!');
            return false;
        }
    });
</script>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">{{ __('admin.Dashboard') }}</a></li>

    <li class="breadcrumb-item"><a href="#">{{ __('admin.Roles') }}</a></li>
</ol>
@endsection