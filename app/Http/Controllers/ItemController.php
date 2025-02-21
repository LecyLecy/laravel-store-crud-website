<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;

class ItemController extends Controller
{
    public function Title(Request $request) {
        $title = 'Welcome';
        return view('welcome', compact('title'));
    }

    public function mainTitle(Request $request) {
        $title = 'Daftar Barang';
        $items = Item::with('category')->get();
        return view('main', compact('title', 'items'));
    }

    public function crudTitle(Request $request) {
        $title = 'Ubah Barang';
        $items = Item::with('category')->get();
        return view('crud', compact('title', 'items'));
    }

    public function createPage(Request $request) {
        $categories = Category::all();
        return view('create', compact('categories'));
    }

    public function createItem(ItemRequest $request) {
        
        $extension = $request->file('image')->getClientOriginalExtension();
        $fileName = $request->item_name . '_' . time() . '.' . $extension;
        $request->file('image')->storeAs('public/image/', $fileName);

        Item::create( [
            'item_name' => $request->item_name,
            'item_price' => $request->item_price,
            'item_amount' => $request->item_amount,
            'item_image' => $fileName,
            'category_id' => $request->category_id,
        ]);

        return redirect('/crud');
    }

    public function updatePage($id) {
        $item = Item::find($id);
        $categories = Category::all();
        return view('update', compact('item', 'categories'));
    }

    public function updateItem($id, ItemRequest $request) {
        $item = Item::find($id);

        $extension = $request->file('image')->getClientOriginalExtension();
        $fileName = $request->item_name . '_' . time() . '.' . $extension;
        $request->file('image')->storeAs('public/image/', $fileName);

        $item->update( [
            'item_name' => $request->item_name,
            'item_price' => $request->item_price,
            'item_amount' => $request->item_amount,
            'item_image' => $fileName,
            'category_id' => $request->category_id,
        ]);

        return redirect('/crud');
    }

    public function deleteItem($id) {
        Item::destroy($id);
        return redirect('/crud');
    }
}
