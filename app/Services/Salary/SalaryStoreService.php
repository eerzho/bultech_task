<?php

namespace App\Services\Salary;

use App\Components\Request\DataTransfer;
use App\Models\Salary\Salary;
use App\Services\BaseService\BaseService;

/**
 * @property Salary       $salary
 * @property DataTransfer $request
 */
class SalaryStoreService extends BaseService
{
    private Salary $salary;
    private DataTransfer $request;

    /**
     * @param Salary       $salary
     * @param DataTransfer $request
     */
    public function __construct(Salary $salary, DataTransfer $request)
    {
        $this->salary = $salary;
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function run(): bool
    {
        $this->salary->salary = $this->request->get('salary');
        $this->salary->work_days = $this->request->get('work_days');
        $this->salary->complete_work_days = $this->request->get('complete_work_days');
        $this->salary->year = $this->request->get('year');
        $this->salary->month = $this->request->get('month');

        return $this->salary->save();
    }
}
