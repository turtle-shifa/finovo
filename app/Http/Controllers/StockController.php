<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Category;
use App\Models\Company;
use App\Models\User;

class StockController extends Controller
{
    //
    public function store(Request $request)
{
    $request->validate([
        'category_id' => 'required|exists:categories,id',
        'product_id' => 'required|exists:products,id',
        'variant' => 'nullable|string',
        'batch_number' => 'nullable|string|unique:stocks,batch_number',
        'quantity' => 'required|integer|min:1',
        'purchase_price' => 'required|numeric|min:0',
        'selling_price' => 'required|numeric|min:0',
    ]);

    // Generate batch number if user did not provide one
    if (!$request->batch_number) {
        $batch_number = 'B' . strtoupper(uniqid()); // e.g., B64F3A1C9E2
        $request->merge(['batch_number' => $batch_number]);
    }

    $product = Product::find($request->product_id);
    $company = $product->company;

    $stock = Stock::create([
    'company_id'     => $company->id,
    'category_id'    => $request->category_id,
    'product_id'     => $request->product_id,
    'variant'        => $request->variant,
    'batch_number'   => $request->batch_number ?? ('B' . strtoupper(uniqid())),
    'quantity'       => $request->quantity,
    'purchase_price' => $request->purchase_price,
    'selling_price'  => $request->selling_price,
    ]);

    return redirect()->back()->with('success', 'Inbound stock added successfully!');
}
public function index(Request $request) {
    $categories = Category::with('products')->get();

    $selectedCategory = $request->get('category_id');
    $products = $selectedCategory ? Product::where('category_id', $selectedCategory)->get() : collect();

    $selectedProduct = $request->get('product_id');
    $variants = $selectedProduct ? Product::find($selectedProduct)->variants : collect();

    $selectedVariant = $request->get('variant');

    $userID = session('user_id');
    $company = User::find($userID)->company;
    $companyID = $company->id;

    $stocksQuery = Company::find($companyID)->stocks();

    if ($selectedCategory) {
        $stocksQuery->where('category_id', $selectedCategory);
    }
    if ($selectedProduct) {
        $stocksQuery->where('product_id', $selectedProduct);
    }
    if ($selectedVariant) {
        $stocksQuery->where('variant', $selectedVariant);
    }

    $allStocks = $stocksQuery->orderBy('created_at', 'desc')->paginate(10);

    return view('stock', compact(
        'categories', 'products', 'variants', 
        'selectedCategory', 'selectedProduct', 'selectedVariant', 'allStocks'
    ));
}
}
