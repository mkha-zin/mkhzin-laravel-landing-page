<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    function index(string $slug)
    {
        $data['employee'] = Employee::where('slug', $slug)->firstOrFail();
        return view('employees.index', $data);
    }
}
