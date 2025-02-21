@extends('layouts.navbar')

@section('container')

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="w-75">
        <div class="card shadow p-4">
            <h2 class="text-center mb-4">Faktur Pembelian</h2>

            <p class="text-center">
                <strong>Nomor Invoice:</strong> 
                {{ 'INV-' . now()->format('Ymd-His') . '-' . Auth::id() }}
            </p>

            @if($carts->isEmpty())
                <p>Keranjang kosong</p>
            @else
                <table class="table table-bordered text-center shadow-sm rounded">
                    <thead class="table-dark">
                        <tr>
                            <th>Kategori</th>
                            <th>Nama</th>
                            <th>Kuantitas</th>
                            <th>Harga Barang</th>
                            <th>Harga Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($carts as $cart)
                            <tr>
                                <td>{{ $cart->item->category->category }}</td>
                                <td>{{ $cart->item->item_name }}</td>
                                <td>{{ $cart->item_amount }}</td>
                                <td>Rp. {{ number_format($cart->item->item_price, 2, ',', '.') }}</td>
                                <td>Rp. {{ number_format($cart->price_total, 2, ',', '.') }}</td>
                                <td>
                                    <form action="{{ route('deleteCart', ['id' => $cart->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE') 
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus barang ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <form action="{{ route('buyItems', ['user_id' => Auth::id()]) }}" method="POST">
                    @csrf
                    <div class="text-end mt-3">
                        <h4>Total Harga: <span id="total-price">Rp. {{ number_format($total_price, 2, ',', '.') }}</span></h4>
                    </div>

                    <div class="mt-4">
                        <label>Alamat:</label>
                        <input type="text" name="alamat" class="form-control mb-2" placeholder="Masukkan Alamat Anda" required>

                        <label>Kode Pos:</label>
                        <input type="text" name="kode_pos" class="form-control mb-4" placeholder="Masukkan Kode Pos Anda" required>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-lg px-5 py-3">Beli Barang</button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>

@endsection
