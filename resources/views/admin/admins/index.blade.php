@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">{{ __('admin.Admin Management') }}</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                @can('adminmanagement-create')
                    <a class="btn btn-success" href="{{ route('admin-management.create') }}"><i class="fas fa-plus-square"></i>{{ __('admin.Create New Account') }}</a>
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
                            <th>{{ __('admin.Email') }}</th>
                            <th>{{ __('admin.Roles') }}</th>
                            <th>{{ __('admin.Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($admins as $key => $adm)
                        <tr>
                            <td class="text-center">{{ ++$key }}</td>
                            <td class="text-center">{{ $adm->name }}</td>
                            <td class="text-center">{{ $adm->email }}</td>
                            <td class="text-center">
                              @if(!empty($adm->getRoleNames()))
                                @foreach($adm->getRoleNames() as $keyRole => $valueRole)
                                  <h5><span class="badge bg-warning">{{ $valueRole }}</span></h5>
                                @endforeach
                              @endif
                            </td>
                            <td class="text-center">
                                @can('adminmanagement-edit')
                                    <a class="btn btn-sm btn-primary" href="{{ route('admin-management.edit',$adm->id) }}">{{ __('admin.Edit') }}</a>
                                @endcan
                                @can('adminmanagement-destroy')
                                <form method="post" action="{{ route('admin-management.destroy', $adm->id) }}" style="display: inline;" class="delete_admin">
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
                        Showing {{ $admins->firstItem() }} to {{ $admins->lastItem() }} of {{ $admins->total() }} entries
                    </div>
                </div>
                <div class="float-right">
                    {{ $admins->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
  <!-- /.card -->
@endsection 


@section('js_inline')
<script type="text/javascript">
    $('form.delete_admin').click(function (event) {
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

    <li class="breadcrumb-item"><a href="#">{{ __('admin.Admin Management') }}</a></li>
</ol>
@endsection