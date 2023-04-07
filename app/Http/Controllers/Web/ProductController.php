<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductGallery;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('galleries', 'category')->get();
        $categories = ProductCategory::all();
        return view('pages.produk', compact('products', 'categories'));
    }

    public function get(Product $product)
    {
        $categories = ProductCategory::all();
        $html = "
        <input type='hidden' name='id' value='$product->id'>
        <div class='validation-container mb-4'>
            <div class='form-floating'>
                <input type='text' class='form-control' id='name' name='name' placeholder='Nama' value='$product->name'>
                <label for='name'>Nama</label>
            </div>
        </div>
        <div class='validation-container mb-4'>
            <div class='form-floating'>
                <select class='form-select' id='categories_id' name='categories_id' aria-label='Floating label select example'>";
        foreach ($categories as $category) {
            if ($category->id == $product->categories_id) {
                $html .= "<option value='$category->id' selected>$category->name</option>";
            } else {
                $html .= "<option value='$category->id'>$category->name</option>";
            }
        }
        $html .= "
                </select>
                <label for='categories_id'>Kategori</label>
            </div>
        </div>
        <div class='validation-container mb-4'>
            <div class='input-group'>
                <span class='input-group-text'>Rp</span>
                <input type='number' class='form-control' id='price' name='price' placeholder='Harga' value='$product->price'>
            </div>
        </div>
        <div class='validation-container mb-4'>
            <div class='form-floating'>
                <textarea class='form-control' id='description' name='description' placeholder='Deskripsi' style='height: 100px'>$product->description</textarea>
                <label for='description'>Deskripsi</label>
            </div>
        </div>
        ";
        return response()->json($html);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'categories_id' => 'required',
            'point' => 'required',
            'photos' => 'required',
        ], [
            'name.required' => 'Nama produk harus diisi',
            'price.required' => 'Harga produk harus diisi',
            'price.numeric' => 'Harga produk harus berupa angka',
            'description.required' => 'Deskripsi produk harus diisi',
            'categories_id.required' => 'Kategori produk harus diisi',
            'point.required' => 'Tag produk harus diisi',
            'photos.required' => 'Foto produk harus diisi',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'categories_id' => $request->categories_id,
            'point' => $request->point,
        ]);

        for ($i = 0; $i < count($request->photos); $i++) {
            ProductGallery::create([
                "url" => "images/" . $request->file('photos')[$i]->getClientOriginalName(),
                "products_id" => $product->id,
            ]);
            $request->file('photos')[$i]->storeAs('public/images', $request->file('photos')[$i]->getClientOriginalName());
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'categories_id' => 'required',
        ], [
            'name.required' => 'Nama produk harus diisi',
            'price.required' => 'Harga produk harus diisi',
            'price.numeric' => 'Harga produk harus berupa angka',
            'description.required' => 'Deskripsi produk harus diisi',
            'categories_id.required' => 'Kategori produk harus diisi',
        ]);

        $product = Product::find($request->id);
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'categories_id' => $request->categories_id,
        ]);

        return redirect()->back()->with('success', 'Produk berhasil diubah');
    }

    public function delete(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus');
    }
}
