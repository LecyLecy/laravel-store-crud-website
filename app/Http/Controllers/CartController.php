<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function plusCart(Request $request) {
        $item = Item::findOrFail($request->item_id);

        $item_amount = $request->input('item_amount');
        $price_total = $item->item_price * $item_amount;

        if ($item_amount== 0) {
            Cart::where('user_id', $request->user_id)->where('item_id', $request->item_id)->delete();
        } else {
            Cart::create([
                'user_id' => $request->user_id,
                'item_id' => $request->item_id,
                'item_amount' => $item_amount,
                'price_total' => $price_total,
            ]);
        }

        return redirect('/main');
    }

    public function fakturPage() {
        $items = Item::all();
        $userId = Auth::user()->id;
        $carts = Cart::where('user_id', $userId)->get();

        $total_price = $carts->sum('price_total');

        return view('faktur', [
            'title' => 'Checkout',
            'items' => $items,
            'carts' => $carts,
            'total_price' => $total_price,
        ]);
    }

    public function deleteCheckout($id)
    {
        $userId = Auth::id();
        Cart::where('user_id', $userId)->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Barang berhasil dihapus dari keranjang!');
    }   

    public function buyItems(Request $request, $user_id)
    {
        $request->validate([
            'alamat' => 'required|string',
            'kode_pos' => 'required|integer',
        ]);

        $carts = Cart::where('user_id', $user_id)->get();

        foreach ($carts as $cart) {
            Item::where('id', $cart->item_id)->decrement('item_amount', $cart->item_amount);
        }
    
        Cart::where('user_id', $user_id)->delete();
        return redirect()->route('main')->with('success', 'Pembelian berhasil!');
    }
}