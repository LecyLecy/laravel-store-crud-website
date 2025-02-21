<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Allow all users to submit this form
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id'   => 'required|string',
            'item_name'     => 'required|string|min:5|max:80',
            'item_price'    => 'required|integer',
            'item_amount'   => 'required|integer',
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',  // Max 2MB file size
        ];
    }

    /**
     * Custom error messages for validation.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'category_id.required'   => 'Kategori Barang wajib diisi.',
            'item_name.required'     => 'Nama Barang wajib diisi.',
            'item_name.min'          => 'Nama Barang minimal 5 huruf.',
            'item_name.max'          => 'Nama Barang maksimal 80 huruf.',
            'item_price.required'    => 'Harga Barang wajib diisi.',
            'item_price.integer'     => 'Harga Barang harus berupa angka.',
            'item_amount.required'   => 'Jumlah Barang wajib diisi.',
            'item_amount.integer'    => 'Jumlah Barang harus berupa angka.',
            'image.required'         => 'Foto Barang wajib diunggah.',
            'image.image'            => 'File harus berupa gambar.',
            'image.mimes'            => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'image.max'              => 'Ukuran gambar tidak boleh lebih dari 2MB.',
        ];
    }
}
