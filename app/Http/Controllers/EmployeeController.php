<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EmployeeValidator;
use Illuminate\Support\Facades\Storage;
use App\Employee;
use App\Company;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::paginate(10);
        $companies = Company::all();
        return view('employees.index', compact('employees', 'companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        return view('employees.create', compact('companies'));
    }


    /**
     * The function stores a new employee record in the database and redirects to the employees index
     * page with a success message.
     * 
     * @param EmployeeValidator request The `store` function you provided is a method that stores a new
     * employee record in the database based on the data provided in the `EmployeeValidator` request.
     * The function extracts the necessary data from the request object and assigns it to the
     * corresponding fields of the `Employee` model before saving it to the
     * 
     * @return The `store` function is returning a redirect response to the route named
     * 'employees.index' with a success message 'Успешно добавлено!' (which translates to 'Successfully
     * added!' in English).
     */
    public function store(EmployeeValidator $request)
    {
        $employee = new Employee;
        $employee->first_name = $request->input('first_name');
        $employee->last_name = $request->input('last_name');
        $employee->company_id = $request->input('company_id');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');
    
        $employee->save();
    
        return redirect()->route('employees.index')->with('success', 'Успешно добавлено!');
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
        $employee = Employee::find($id)->first();
        $companies = Company::all();
        return view('employees.edit', compact('employee', 'companies'));
    }


/**
 * This PHP function updates an employee record based on the input data provided and redirects to the
 * employees index page with a success message.
 * 
 * @param EmployeeValidator request The `EmployeeValidator ` parameter in the `update` function
 * is type-hinted to indicate that it expects an instance of the `EmployeeValidator` class. This is
 * typically a form request class that contains validation rules for the employee update request.
 * @param id The `` parameter in the `update` function represents the unique identifier of the
 * employee record that you want to update. It is typically used to locate the specific employee record
 * in the database that needs to be updated.
 * 
 * @return The `update` function is returning a redirect response to the route named 'employees.index'
 * with a success message 'Успешно обновлено!'
 */
    public function update(EmployeeValidator $request, $id)
    {
        $employee = Employee::find($id)->first();
        $employee->first_name = $request->input('first_name');
        $employee->last_name = $request->input('last_name');
        $employee->company_id = $request->input('company_id');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');
    
        $employee->save();
    
        return redirect()->route('employees.index')->with('success', 'Успешно обновлено!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id)->first();
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Успешно удалено!');
    }
}
