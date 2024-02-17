<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    private static int $elemOnPage = 25;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::paginate(self::$elemOnPage);

        return EmployeeResource::collection($employees);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $employee = Employee::create($request->all());

        return EmployeeResource::make($employee)->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return EmployeeResource::make($employee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->all());

        return EmployeeResource::make($employee);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->json(null, 204);
    }

    public function highestSalary()
    {
        //get employees with highest salary for each country
        $employees = Employee::select('employees.*')
            ->join(DB::raw('(SELECT MAX(salary) AS max_salary, country_id FROM employees GROUP BY country_id) AS max_salaries'), function ($join) {
                $join->on('employees.salary', '=', 'max_salaries.max_salary')
                    ->on('employees.country_id', '=', 'max_salaries.country_id');
            })->get();

        return EmployeeResource::collection($employees);
    }

    public function getByPosition(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'position' => 'required|exists:positions,name',
        ]);

        // return validation error
        if($validate->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'data' => $validate->errors(),
            ], 422);
        }

        //get position by name
        $position = Position::where('name', '=', $request->get('position'))->first();

        $employees = $position->employees()->paginate(self::$elemOnPage);

        return EmployeeResource::collection($employees);
    }

}
