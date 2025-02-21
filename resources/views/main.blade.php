@extends('layouts.navbar')

@section('container')

<div class="container d-flex flex-column justify-content-center align-items-center mt-5">
    <h2 class="mb-4">{{ $title }}</h2>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <a href="/faktur/{{ Auth::id() }}">
        <img src="{{ asset('storage/image/cart.jpg') }}" alt="Cart" width="80">
    </a>

    <table class="table table-striped table-bordered text-center shadow-lg rounded" style="width: 80%;">
        <thead class="table-dark">
            <tr>
                <th>Kategori</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stock</th>
                <th>Gambar</th>
                <th>Jumlah Beli</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->category->category }}</td>
                    <td>{{ $item->item_name }}</td>
                    <td>Rp.{{ number_format($item->item_price, 0, ',', '.') }}</td>
                    <td>{{ $item->item_amount }}</td>
                    <td>
                        <img src="{{ asset('storage/image/'.$item->item_image) }}" alt="Image of {{ $item->item_name }}" width="50">
                    </td>
                    <td>
                        @if($item->item_amount > 0)
                        <form action="/plusCart/{{ $item->id }}/{{ Auth::id() }}" method="POST">
                            @csrf
                            <input type="number" name="item_amount" value="1" min="1" max="{{ $item->item_amount }}" class="form-control" style="width: 80px; display:inline;">
                    </td>
                    <td>
                            <button type="submit" class="btn btn-primary">+ Keranjang</button>
                        </form>
                        @else
                            <span class="text-danger">Barang sudah habis, silakan tunggu hingga barang di-restock ulang</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection