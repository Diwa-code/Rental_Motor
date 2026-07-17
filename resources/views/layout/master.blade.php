<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100" style="padding-top: 70px;">
    {{--navbar--}}
    @include('layout.sidebar')
    {{-- content --}}
    <div class="container mt-3 mb-4 flex-grow-1">
        @yield('content')
    </div>

    {{-- footer --}}
    @include('layout.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Script global untuk mencegah double-submit pada semua form --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('form').forEach(function (form) {
                form.addEventListener('submit', function (e) {
                    // Jika form sudah pernah disubmit, blokir submit berikutnya
                    if (form.dataset.submitted === 'true') {
                        e.preventDefault();
                        return false;
                    }

                    // Untuk form DELETE dengan confirm dialog: jika user klik "Cancel",
                    // jangan tandai form sebagai submitted
                    var submitBtn = form.querySelector('button[type="submit"]');
                    if (submitBtn && submitBtn.getAttribute('onclick') &&
                        submitBtn.getAttribute('onclick').includes('confirm')) {
                        // confirm() sudah dijalankan oleh onclick sebelum event submit.
                        // Jika sampai ke sini, berarti user sudah klik OK.
                    }

                    // Tandai form sebagai sudah disubmit
                    form.dataset.submitted = 'true';

                    // Disable semua tombol submit di form ini dan tampilkan spinner
                    form.querySelectorAll('button[type="submit"]').forEach(function (btn) {
                        btn.disabled = true;
                        var originalText = btn.innerHTML;
                        btn.dataset.originalText = originalText;
                        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Memproses...';
                    });
                });
            });

            // Reset form jika user kembali ke halaman via tombol "Back" browser
            window.addEventListener('pageshow', function (event) {
                if (event.persisted) {
                    document.querySelectorAll('form').forEach(function (form) {
                        form.dataset.submitted = 'false';
                        form.querySelectorAll('button[type="submit"]').forEach(function (btn) {
                            btn.disabled = false;
                            if (btn.dataset.originalText) {
                                btn.innerHTML = btn.dataset.originalText;
                            }
                        });
                    });
                }
            });
        });
    </script>
</body>

</html>