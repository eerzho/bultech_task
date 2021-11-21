<?php

namespace App\Http\Resources\SalaryOption;

use App\Http\Resources\BaseResource\BaseResource;

class SalaryOptionResource extends BaseResource
{
    /**
     * @return string[]
     */
    public static function getFields(): array
    {
        return [
            'id',
            'salary_id',
            'is_invalid',
            'invalid_group',
            'is_retired',
        ];
    }
}
