<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all(); // no filtering by user
        return view('dashboard', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destination = public_path('images/company_logo');
            $file->move($destination, $filename);
            $logoPath = explode('public/', 'images/company_logo/' . $filename)[0] ?? 'images/company_logo/' . $filename;
        }

        Company::create([
            'name' => $request->name,
            'address' => $request->address,
            'logo' => $logoPath,
        ]);

        return redirect()->route('dashboard')->with('success', 'Company created!');
    }
}
