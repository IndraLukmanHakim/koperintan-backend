<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductGalleryController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('pages.produk-gallery', compact('products'));
    }
}
