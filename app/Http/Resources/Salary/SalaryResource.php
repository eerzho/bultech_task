<?php

namespace App\Http\Resources\Salary;

use App\Http\Resources\BaseResource\BaseResource;
use App\Http\Resources\SalaryCalculate\SalaryCalculateResource;
use App\Http\Resources\SalaryOption\SalaryOptionResource;

class SalaryResource extends BaseResource
{
    /**
     * @return string[]
     */
    public static function getFields(): array
    {
        return [
            'id',
            'work_days',
            'complete_work_days',
            'year',
            'month',
            'option' => SalaryOptionResource::class,
            'calculate' => SalaryCalculateResource::class,
        ];
    }
}
