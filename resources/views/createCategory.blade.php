<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow" style="width: 400px;">
            <h2 class="text-center mb-4">Tambah Kategori</h2>

            <form action="/createCategory" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="category" class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control" id="category" name="category" placeholder="Masukkan Nama Kategori">
                    @error('category')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success w-100">Tambahkan Kategori</button>
            </form>

            <div class="text-center mt-3">
                <a href="/create" class="text-decoration-none">Kembali ke Tambah Barang</a>
            </div>
        </div>
    </div>

</body>
</html>
