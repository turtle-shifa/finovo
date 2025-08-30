<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Company;

class CategoryController extends Controller
{
    //
    public function index(){
        if (session()->has('user_id')){

            $userId = session('user_id');
            $userCompany = Company::where('user_id','=',$userId)->first();
            if ($userCompany){
                $categories = Category::where('company_id', $userCompany->id)->orderBy('name', 'asc')->paginate(10);
                return view('category',compact('categories'));
            }else{
                return redirect('/company-create')->with('error','You must have a company to create a category.');
            }    
        }else{
            return redirect('/signin')->with('error','You must be logged in to create a category.');
        }
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $userId = session('user_id');
        $userCompany = Company::where('user_id','=',$userId)->first();

        Category::create([
            'name' => $request->name,
            'company_id'=>$userCompany->id
        ]);

        return back()->with('success', 'Category created successfully!');
    }
    public function edit($id){
        $category = Category::find($id);

        if(session()->has('user_id') && $category && $category->company->user_id == session('user_id')){
            return view('category-edit', compact('category'));
        } else {
            return redirect('/category')->with('error','Unauthorized or category not found.');
        }
    }

    public function delete($id){
        $category = Category::find($id);

        if(session()->has('user_id') && $category && $category->company->user_id == session('user_id')){
            $category->delete();
            return redirect('/category')->with('success','Category deleted successfully!');
        } else {
            return redirect('/category')->with('error','Unauthorized or category not found.');
        }
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::find($id);
        if(session()->has('user_id') && $category && $category->company->user_id == session('user_id')){
            $category->update(['name' => $request->name]);
            return redirect('/category')->with('success','Category updated successfully!');
        } else {
            return redirect('/category')->with('error','Unauthorized or category not found.');
        }

    }
}
