@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">{{ __('admin.Roles Management') }}</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                @can('rolemanagement-create')
                    <a class="btn btn-success" href="{{ route('role-management.create') }}"><i class="fas fa-plus-square"></i>{{ __('admin.New Role') }}</a>
                @endcan
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">  
                <table class="table table-bordered">
                    <thead>
                        <tr class="bg-gray text-center">
                            <th>{{ __('admin.No') }}</th>
                            <th>{{ __('admin.Name') }}</th>
                            <th>{{ __('admin.Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($roles as $key => $role)
                        <tr>
                            <td class="text-center">{{ ++$key }}</td>
                            <td class="text-center">{{ $role->name }}</td>
                            <td class="text-center">
                                @can('rolemanagement-edit')
                                    <a class="btn btn-sm btn-primary" href="{{ route('role-management.edit',$role->id) }}">{{ __('admin.Edit') }}</a>
                                @endcan
                                @can('rolemanagement-destroy')
                                <form method="post" action="{{ route('role-management.destroy', $role->id) }}" style="display: inline;" class="delete_role">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-sm btn-danger delete_confirm'" style="display: inline;">{{ __('admin.Delete') }}</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <div class="float-left">
                    <div class="dataTables_info">
                        Showing {{ $roles->firstItem() }} to {{ $roles->lastItem() }} of {{ $roles->total() }} entries
                    </div>
                </div>
                <div class="float-right">
                    {{ $roles->links() }}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection 

@section('js_inline')
<script type="text/javascript">
    $('form.delete_role').click(function (event) {
        var form =  $(this).closest("form");
        event.preventDefault();
        swal.fire({
            title: 'Are you sure you want to delete this record?',
            text: "If you delete this, it will be gone forever.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            showDenyButton: true,
            denyButtonText: 'Cancel',
        })
        .then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
            return false;
        }); 
    }); 
</script>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">{{ __('admin.Dashboard') }}</a></li>

    <li class="breadcrumb-item"><a href="#">{{ __('admin.Roles') }}</a></li>
</ol>
@endsection