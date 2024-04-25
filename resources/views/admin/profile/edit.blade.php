@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">{{ __('admin.Profile') }}</h4>
        </div>
    </div>
</div>
<div class="row">
    @include('admin.profile.partials.update-profile-information-form')
    @include('admin.profile.partials.update-password-form')
</div>
@endsection

@section('js_inline')
<script>

</script>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">{{ __('admin.Dashboard') }}</a></li>

    <li class="breadcrumb-item"><a href="#">{{ __('admin.Profile') }}</a></li>
</ol>
@endsection