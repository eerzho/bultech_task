<?php

namespace App\Services\SalaryOption;

use App\Components\Request\DataTransfer;
use App\Models\SalaryOption\SalaryOption;
use App\Services\BaseService\BaseService;

/**
 * @property SalaryOption $salaryOption
 * @property DataTransfer $request
 */
class SalaryOptionStoreService extends BaseService
{
    private SalaryOption $salaryOption;
    private DataTransfer $request;

    /**
     * @param SalaryOption $salaryOption
     * @param DataTransfer $request
     */
    public function __construct(SalaryOption $salaryOption, DataTransfer $request)
    {
        $this->salaryOption = $salaryOption;
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function run(): bool
    {
        $this->salaryOption->salary_id = $this->request->get('salary_id');
        $this->salaryOption->is_invalid = $this->request->get('is_invalid');
        $this->salaryOption->invalid_group = $this->request->get('invalid_group');
        $this->salaryOption->is_retired = $this->request->get('is_retired');

        return $this->salaryOption->save();
    }
}
