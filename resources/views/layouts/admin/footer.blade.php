<!-- core:js -->
<script src="{{ asset('template/assets/vendors/core/core.js') }}"></script>

<!-- endinject -->

<!-- Plugin js for this page -->
<script src="{{ asset('template/assets/vendors/flatpickr/flatpickr.min.css') }}"></script>
<script src="{{ asset('template/assets/vendors/apexcharts/apexcharts.min.js') }}"></script>

<!-- End plugin js for this page -->

<!-- inject:js -->
<script src="{{ asset('template/assets/vendors/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('template/assets/js/template.js') }}"></script>

<!-- endinject -->

<!-- Custom js for this page -->

<script src="{{ asset('template/assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('template/assets/js/sweet-alert.js') }}"></script>

<script src="{{ asset('template/assets/vendors/select2/select2.min.js') }}"></script>

<!-- End custom js for this page -->

<!-- Toast -->
<script>

    function showNotification(type = 'error', msg = 'Oops...') {
        Swal.fire({
            icon: type,
            title: msg
        })
    }
</script>