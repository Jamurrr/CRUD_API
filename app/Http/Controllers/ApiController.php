<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Http\Requests\EmployeeValidator;

class ApiController extends Controller
{
    /**
     * The index function retrieves all employees from the database and returns them as a JSON response.
     * 
     * @return An array of all employees is being returned in JSON format with a HTTP status code of 200.
     */
    public function index()
    {
        $employees = Employee::all();
        return response()->json($employees, 200);
    }

    /**
     * The function `store` creates a new employee record using the data provided in the request and
     * returns a JSON response with the created employee data.
     * 
     * @param EmployeeValidator request The `EmployeeValidator ` parameter in the `store` function
     * is type-hinted with `EmployeeValidator`, which means it is expecting an instance of the
     * `EmployeeValidator` class to be passed as an argument when the function is called. This is commonly
     * used in Laravel for form validation.
     * 
     * @return A JSON response containing the newly created employee data with a status code of 201
     * (Created) is being returned.
     */
    public function store(EmployeeValidator $request)
    {
        $employee = Employee::create($request);

        return response()->json($employee, 201);
    }

    /**
     * This PHP function deletes an employee record by ID and returns a success message in JSON format.
     * 
     * @param id The `destroy` method in the code snippet is used to delete an employee record from the
     * database based on the provided ``. The `` parameter represents the unique identifier of the
     * employee record that needs to be deleted.
     * 
     * @return The `destroy` method is deleting an employee record with the given `` and then returning
     * a JSON response with a success message 'Успешно удалено!' and a status code of 200.
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return response()->json(['message' => 'Успешно удалено!'], 200);
    }
}
