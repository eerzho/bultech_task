<?php

namespace App\Http\Controllers\Api\Salary;

use App\Http\Controllers\Controller;
use App\Http\Requests\Salary\SalaryCalculateRequest;

class SalaryController extends Controller
{
    public function calculate(SalaryCalculateRequest $request)
    {
        dd($request->post());
    }
}
