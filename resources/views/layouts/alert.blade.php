@if (session('success'))
    <div class="alert alert-success" role="alert" id="successAlert" style="max-width: 300px; margin-left: auto;">
        <div style="text-align: lift;">
            {{ session('success') }}
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger" role="alert" id="errorAlert" style="max-width: 300px; margin-left: auto;">
        <div style="text-align: lift;">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    </div>
@endif

<script>
    // Cari elemen alert
    const successAlert = document.getElementById('successAlert');
    const errorAlert = document.getElementById('errorAlert');

    // Periksa jika alert ada
    if (successAlert) {
        // Hilangkan alert setelah 3 detik
        setTimeout(function() {
            successAlert.remove();
        }, 3000);
    }

    if (errorAlert) {
        // Hilangkan alert setelah 3 detik
        setTimeout(function() {
            errorAlert.remove();
        }, 3000);
    }
</script>
