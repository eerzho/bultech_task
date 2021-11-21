<?php

namespace App\Http\Resources\SalaryCalculate;

use App\Http\Resources\BaseResource\BaseResource;

class SalaryCalculateResource extends BaseResource
{
    /**
     * @return string[]
     */
    public static function getFields(): array
    {
        return [
            'id',
            'salary_id',
            'clean_salary',
            'opv',
            'vosms',
            'osms',
            'co',
            'ipn',
        ];
    }
}
