<?php

namespace App\Http\Requests\Salary;

use App\Http\Requests\BaseFromRequest\BaseFromRequest;

class SalaryCalculateRequest extends BaseFromRequest
{
    /**
     * @return \string[][]
     */
    public function rules(): array
    {
        return [
            'salary' => [
                'required',
                'integer',
                'min:1',
            ],
            'work_days' => [
                'required',
                'integer',
                'min:1',
                'max:31',
                'gte:complete_work_days',
            ],
            'complete_work_days' => [
                'required',
                'integer',
                'min:1',
                'max:31',
                'lte:work_days',
            ],
            'year' => [
                'required',
                'integer',
            ],
            'month' => [
                'required',
                'integer',
                'min:1',
                'max:12',
            ],
            'is_retired' => [
                'required',
                'boolean',
            ],
            'is_invalid' => [
                'required',
                'boolean',
            ],
            'invalid_group' => [
                'required_if:is_invalid,true',
                'integer',
                'min:1',
                'max:4'
            ],

        ];
    }
}
