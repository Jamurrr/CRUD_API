<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CompanyValidator;
use Illuminate\Support\Facades\Storage;
use App\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::paginate(10);
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }


/**
 * The function stores company information including name, email, website, and logo in a database and
 * redirects to the index page with a success message.
 * 
 * @param CompanyValidator request The `store` function you provided is a method that stores a new
 * Company record based on the data provided in the `CompanyValidator` request. Here's a breakdown of
 * what the function does:
 * 
 * @return The `store` function is returning a redirect response to the `companies.index` route with a
 * success message 'Успешно добавлено!' (which translates to 'Successfully added!' in English) stored
 * in the session flash data.
 */
    public function store(CompanyValidator $request)
    {
        $company = new Company;
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->website = $request->input('website');
    
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $company->logo = $path;
        }
        $company->save();
    
        return redirect()->route('companies.index')->with('success', 'Успешно добавлено!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id)->first();
        return view('companies.edit', compact('company'));
    }


/**
 * The update function in PHP updates a company's information including name, email, website, and logo
 * if provided, and then redirects to the companies index page with a success message.
 * 
 * @param CompanyValidator request The `update` function you provided seems to be updating a company
 * record in a database based on the data provided in the `` object. It also handles file
 * uploads for the company logo.
 * @param id The `id` parameter in the `update` function represents the unique identifier of the
 * company that you want to update. It is typically used to retrieve the specific company record from
 * the database using the `Company::find()` method.
 * 
 * @return The `update` method is returning a redirect response to the `companies.index` route with a
 * success message 'Успешно обновлено!' (which translates to 'Successfully updated!' in English) stored
 * in the session.
 */
    public function update(CompanyValidator $request, $id)
    {
        $company = Company::find($id)->first();
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->website = $request->input('website');
    
        if ($request->hasFile('logo')) {
            if ($company->logo && Storage::disk('public')->exists($company->logo)) {
                Storage::disk('public')->delete($company->logo);
            }

            $path = $request->file('logo')->store('logos', 'public');
            $company->logo = $path;
        }
    
        $company->save();
    
        return redirect()->route('companies.index')->with('success', 'Успешно обновлено!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id)->first();
        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Успешно удалено!');
    }
}
