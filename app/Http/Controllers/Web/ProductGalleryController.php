<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;

class ProductGalleryController extends Controller
{
    public function index()
    {
        $products = Product::with("galleries")->get();
        return view('pages.produk-gallery', compact('products'));
    }

    public function kelola(Product $product)
    {
        return view('pages.produk-gallery-kelola', compact('product'));
    }

    public function create(Product $product, Request $request)
    {
        for ($i = 0; $i < count($request->images); $i++) {
            ProductGallery::create([
                "url" => "images/" . $request->file('images')[$i]->getClientOriginalName(),
                "products_id" => $product->id,
            ]);
            $request->file('images')[$i]->storeAs('public/images', $request->file('images')[$i]->getClientOriginalName());
        }

        return back()->with('success', 'Produk gallery berhasil ditambahkan');
    }

    public function delete(ProductGallery $productGallery)
    {
        $productGallery->delete();
        return back()->with('success', 'Produk gallery berhasil dihapus');
    }
}
