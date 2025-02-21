@extends('layouts.navbar')

@section('container')

<div class="container d-flex flex-column justify-content-center align-items-center mt-5">
    <h2 class="mb-4">{{ $title }}</h2>

    <div class="mb-4 d-flex justify-content-center">
        <a href="/create" class="btn btn-success">Tambah Barang</a>
    </div>

    <table class="table table-striped table-bordered text-center shadow-lg rounded" style="width: 80%;">
        <thead class="table-dark">
            <tr>
                <th scope="col">Kategori</th>
                <th scope="col">Nama</th>
                <th scope="col">Harga</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Gambar</th>
                <th scope="col">Ubah</th>
                <th scope="col">Hapus</th>
            </tr>
        </thead>

        <tbody>
            @foreach($items as $item)
                <tr data-id="{{ $item->id }}" data-stock="{{ $item->item_amount }}">
                    <td>{{ $item->category->category ?? 'Tidak Ada Kategori' }}</td>
                    <td>{{ $item->item_name }}</td>
                    <td>Rp.{{ number_format($item->item_price, 0, ',', '.') }}</td>
                    <td class="item-amount">{{ $item->item_amount }}</td>
                    <td>
                        <img src="{{ asset('storage/image/'.$item->item_image) }}" alt="Image of {{ $item->item_name }}" width="50">
                    </td>
                    <td>
                        <a href="/update/{{ $item->id }}">
                            <button type="button" class="btn btn-warning btn-sm">Ubah</button>
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('deleteItem', ['id' => $item->id]) }}" method="POST" class="d-inline add-to-cart-form" data-item-name="">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus barang ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection