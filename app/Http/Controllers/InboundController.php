<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class InboundController extends Controller
{
    //
    public function index(Request $request) {

        if (!session()->has('user_id')) {
            return redirect('/signin')->with('error','You must be logged in to purchase products.');
        }

        $userID = session('user_id');
        $company = User::find($userID)->company;
        $companyID = $company->id;

        $categories = Category::where('company_id', $companyID)->with('products')->get();

        $categories = Category::with('products')->get();


        $selectedCategory = $request->get('category_id');
        $products = $selectedCategory ? Product::where('category_id', $selectedCategory)->where('is_active',true)->get() : collect();

        $selectedProduct = $request->get('product_id');
        $variants = $selectedProduct ? Product::find($selectedProduct)->variants : [];

        return view('inbound', compact('categories', 'products', 'variants', 'selectedCategory', 'selectedProduct'));
    }
}
