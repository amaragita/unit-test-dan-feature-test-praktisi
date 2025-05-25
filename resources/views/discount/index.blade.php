<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Diskon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Menghilangkan tombol naik turun pada input number */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Kalkulator Diskon</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('discount.calculate') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="amount" class="form-label">Total Belanja (Rp)</label>
                                <input type="text" class="form-control @error('amount') is-invalid @enderror" 
                                    id="amount" name="amount" required>
                                <input type="hidden" id="amount_value" name="amount_value">
                                @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="discount_percentage" class="form-label">Persentase Diskon (%)</label>
                                <input type="number" class="form-control @error('discount_percentage') is-invalid @enderror" 
                                    id="discount_percentage" name="discount_percentage" min="0" max="100" step="0.01" required>
                                @error('discount_percentage')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Hitung Diskon</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('amount').addEventListener('input', function(e) {
            // Hapus semua karakter non-digit
            let value = this.value.replace(/\D/g, '');
            
            // Format angka dengan titik sebagai pemisah ribuan
            let formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            
            // Update tampilan input
            this.value = formattedValue;
            
            // Simpan nilai asli (tanpa format) ke hidden input
            document.getElementById('amount_value').value = value;
        });

        // Saat form disubmit, gunakan nilai dari hidden input
        document.querySelector('form').addEventListener('submit', function(e) {
            let amountInput = document.getElementById('amount');
            let amountValue = document.getElementById('amount_value');
            amountInput.value = amountValue.value;
        });
    </script>
</body>
</html> 