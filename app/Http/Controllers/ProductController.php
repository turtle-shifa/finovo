<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function create()
    {
        $userId = session('user_id');
        $company = Company::where('user_id', $userId)->first();

        if (!$company) {
            return redirect('/company-create')->with('error','You must have a company to create products.');
        }

        $categories = Category::where('company_id', $company->id)->get();

        return view('product-create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
            'variants.*' => 'nullable|string|max:255',
            'is_active' => 'required|in:0,1',
        ]);

        $userId = session('user_id');
        $company = Company::where('user_id', $userId)->first();

        $product = Product::create([
            'name' => $request->product_name,
            'company_id' => $company->id,
            'category_id' => $request->category_id,
            'variants' => $request->variants,
            'is_active' => $request->is_active,
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = $request->name . time() . '.' . $extension;
            $location = '/images/product/';
            $file->move(public_path() . $location, $fileName);

        $product->update([
            'image' => $location . $fileName
        ]);
        }

        return redirect('/product')->with('success','Product created successfully!');

    }

    public function index(Request $request)
    {
        if (!session()->has('user_id')) {
            return redirect('/signin')->with('error','You must be logged in to see products.');
        }

        $userId = session('user_id');
        $userCompany = Company::where('user_id', $userId)->first();

        if (!$userCompany) {
            return redirect('/company-create')->with('error','You must have a company to see products.');
        }


        $productsQuery = Product::where('company_id', $userCompany->id);

        if ($request->name) {
            $productsQuery->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->category) {
            $productsQuery->whereHas('category', function($q) use ($request) {
                $q->where('name', $request->category); // exact match
            });
        }

        $products = $productsQuery->orderBy('name', 'asc')->paginate(10)->withQueryString();
        $categoriesList = Category::where('company_id', $userCompany->id)->orderBy('name')->get();

        return view('product', compact('products','categoriesList'));
    }


    public function edit($id){
        $product = Product::find($id);
        $userId = session('user_id');
        $company = Company::where('user_id', $userId)->first();
        $categories = Category::where('company_id', $company->id)->get();

        return view('product-edit', compact('categories','product'));
    }

    public function update(Request $request, $id){
        
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
            'variants.*' => 'nullable|string|max:255',
            'is_active' => 'required|in:0,1',
        ]);

        $userId = session('user_id');
        $company = Company::where('user_id', $userId)->first();

        Product::where('id','=',$id)->update([
            'name' => $request->product_name,
            'company_id' => $company->id,
            'category_id' => $request->category_id,
            'variants' => $request->variants,
            'is_active' => $request->is_active,
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = $request->name . time() . '.' . $extension;
            $location = '/images/product/';
            $file->move(public_path() . $location, $fileName);

        $product = Product::findOrFail($id);

        $product->update([
            'image' => $location . $fileName
        ]);
        
        }

        return redirect('/product')->with('success','Product updated successfully!');
    }


    public function delete($id){
        $product = Product::find($id);
        $product->delete();
        return redirect('/product')->with('success','Product deleted successfully!');
        
    }
}
