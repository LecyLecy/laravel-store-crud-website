<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambahkan Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    
    <div class="container d-flex justify-content-center align-items-center mt-5">
        <div class="card p-4 shadow" style="width: 400px;">
            <h2 class="text-center mb-4">Tambah Barang</h2>

            <form action="/create" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label for="category_id" class="form-label">Kategori Barang</label>
                    <select name="category_id" id="category_id" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                        @endforeach
                    </select>
                    <div class="text-center mt-3">
                        <a href="/createCategory" class="btn btn-primary">Tambah Category</a>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="item_name" class="form-label">Nama Barang</label>
                    <input name="item_name" type="text" class="form-control" id="formGroupExampleInput" placeholder="" value="{{ old('release') }}">
                    @error('item_name')
                        <div style="color: red;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="item_price" class="form-label">Harga</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp.</span>
                        <input name="item_price" type="number" class="form-control" id="formGroupExampleInput" placeholder="" value="{{ old('release') }}">
                    </div>
                    @error('item_price')
                        <div style="color: red;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                <label for="item_amount" class="form-label">Jumlah</label>
                    <input name="item_amount" type="decimal" class="form-control" id="formGroupExampleInput" placeholder="" value="{{ old('release') }}">
                    @error('item_amount')
                        <div style="color: red;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Gambar</label>
                    <input name="image" type="file" class="form-control" id="formGroupExampleInput" placeholder="" value="{{ old('release') }}">
                    @error ('image')
                        <div style="color: red;">
                                {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success w-100">Tambahkan Barang</button>
            </form>
        </div>
    </div>

</body>
</html>