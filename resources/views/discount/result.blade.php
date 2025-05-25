<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Perhitungan Diskon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Hasil Perhitungan Diskon</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h5>Detail Diskon:</h5>
                            <p><strong>Persentase Diskon:</strong> {{ $discountPercentage }}%</p>
                        </div>

                        <div class="mb-3">
                            <h5>Perhitungan:</h5>
                            <p><strong>Total Belanja:</strong> Rp{{ number_format($originalAmount, 0, ',', '.') }}</p>
                            <p><strong>Jumlah Diskon:</strong> Rp{{ number_format($discountAmount, 0, ',', '.') }}</p>
                            <hr>
                            <p><strong>Total yang Harus Dibayar:</strong> Rp{{ number_format($finalAmount, 0, ',', '.') }}</p>
                        </div>

                        <a href="{{ route('discount.index') }}" class="btn btn-primary w-100">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 