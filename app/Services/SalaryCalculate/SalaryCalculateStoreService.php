<?php

namespace App\Services\SalaryCalculate;

use App\Components\Request\DataTransfer;
use App\Models\SalaryCalculate\SalaryCalculate;
use App\Services\BaseService\BaseService;

/**
 * @property SalaryCalculate $salaryCalculate
 * @property DataTransfer    $request
 */
class SalaryCalculateStoreService extends BaseService
{
    private SalaryCalculate $salaryCalculate;
    private DataTransfer $request;

    /**
     * @param SalaryCalculate $salaryCalculate
     * @param DataTransfer    $request
     */
    public function __construct(SalaryCalculate $salaryCalculate, DataTransfer $request)
    {
        $this->salaryCalculate = $salaryCalculate;
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function run(): bool
    {
        $this->salaryCalculate->salary_id = $this->request->get('salary_id');
        $this->salaryCalculate->clean_salary = $this->request->get('clean_salary');
        $this->salaryCalculate->opv = $this->request->get('opv');
        $this->salaryCalculate->vosms = $this->request->get('vosms');
        $this->salaryCalculate->osms = $this->request->get('osms');
        $this->salaryCalculate->co = $this->request->get('co');
        $this->salaryCalculate->ipn = $this->request->get('ipn');

        return $this->salaryCalculate->save();
    }
}
