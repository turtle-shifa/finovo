<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function create()
    {
        if (!session('user_id')) {
            return redirect('/signin')->with('error', 'You must be logged in to create a company profile.');
        }else{
            $hasCompany = Company::where('user_id','=',session('user_id'))->first();
            if ($hasCompany){
                return redirect('/dashboard')->with('success',"It looks like you've already created a company profile.");
            }else{
                return view('company_create');
            }
        }

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'website' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'description' => 'nullable|string|max:1000'
        ]);

        $company = Company::create([
            'user_id' => session('user_id'),
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'website' => $request->website,
            'description' => $request->description
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $fileName = $request->name . time() . '.' . $extension;
            $location = '/images/logo/';
            $file->move(public_path() . $location, $fileName);

        $company->update([
            'logo' => $location . $fileName
        ]);
        }

        if ($request->name && $request->email){
            return redirect('/dashboard')->with('success', 'Company profile created successfully.');
        }else{
            return back();
        }
    }
}
