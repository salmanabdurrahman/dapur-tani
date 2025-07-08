@php
    $alertTypes = [
        'success' => 'success',
        'error' => 'error',
        'warning' => 'warning',
        'info' => 'info',
        'status' => 'info',
    ];

    $sessionType = null;
    foreach ($alertTypes as $key => $type) {
        if (session()->has($key)) {
            $sessionType = $key;
            break;
        }
    }

    $message = $sessionType ? session($sessionType) : null;
@endphp

@if ($sessionType && $message)
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "{{ $alertTypes[$sessionType] }}",
                text: "{{ $message }}",
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                timerProgressBar: true,
                width: 420,
            });
        });
    </script>
@endif
