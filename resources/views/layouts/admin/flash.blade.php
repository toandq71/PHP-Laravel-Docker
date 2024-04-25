@if (session('success-message'))
    <div class="row">
        <div class="alert alert-success" role="alert" style="width: 100%">
            {{ session('success-message') }}
        </div>
    </div>
@endif

@if (session('error-message'))
    <div class="row">
        <div class="alert alert-danger" role="alert" style="width: 100%">
            {{ session('error-message') }}
        </div>
    </div>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            <i class="mdi mdi-alert"></i>{{ $error }}
        </div>
    @endforeach
@endif

@if (null !== session('status') && session('msg'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });
        var icon = 'error';
        if ("{{ session('status')}}" == "1") {
            icon = 'success';
        }
        
        Toast.fire({
            icon: icon,
            title: "{{ session('msg') }}"
        })
    </script>
@endif