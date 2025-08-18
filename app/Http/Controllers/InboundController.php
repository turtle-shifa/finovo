<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Category;
use App\Models\Product;

class InboundController extends Controller
{
    //
    public function index(Request $request) {
        $categories = Category::with('products')->get();

        $selectedCategory = $request->get('category_id');
        $products = $selectedCategory ? Product::where('category_id', $selectedCategory)->where('is_active',true)->get() : collect();

        $selectedProduct = $request->get('product_id');
        $variants = $selectedProduct ? Product::find($selectedProduct)->variants : [];

        return view('inbound', compact('categories', 'products', 'variants', 'selectedCategory', 'selectedProduct'));
    }
}
