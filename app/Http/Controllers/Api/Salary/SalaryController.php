<?php

namespace App\Http\Controllers\Api\Salary;

use App\Components\Request\DataTransfer;
use App\Components\Salary\SalaryCalculateComponent;
use App\Exceptions\NotDoneException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Salary\SalaryCalculateRequest;
use App\Http\Resources\Salary\SalaryResource;
use App\Models\Salary\Salary;
use App\Models\SalaryCalculate\SalaryCalculate;
use App\Models\SalaryOption\SalaryOption;
use App\Services\Salary\SalaryStoreService;
use App\Services\SalaryCalculate\SalaryCalculateStoreService;
use App\Services\SalaryOption\SalaryOptionStoreService;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('begin.transaction')->only('store');
    }

    /**
     * @param SalaryCalculateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function calculate(SalaryCalculateRequest $request)
    {
        $salaryCalculate = new SalaryCalculateComponent(new DataTransfer($request->post()));

        return $this->response($salaryCalculate->calculate());
    }

    /**
     * @param SalaryCalculateRequest $request
     * @param Salary                 $salary
     *
     * @return SalaryResource
     * @throws NotDoneException
     */
    public function store(SalaryCalculateRequest $request, Salary $salary)
    {
        $data = $request->post();

        $isSave = (new SalaryStoreService($salary, new DataTransfer($data)))->run();

        $isSave = $isSave && (new SalaryOptionStoreService(new SalaryOption(), new DataTransfer(array_merge([
                'salary_id' => $salary->id
            ], $data))))->run();

        $data = (new SalaryCalculateComponent(new DataTransfer($data)))->calculate();

        $isSave = $isSave && (new SalaryCalculateStoreService(new SalaryCalculate(), new DataTransfer(array_merge([
                'salary_id' => $salary->id
            ], $data))))->run();

        if ($isSave) {

            DB::commit();

            return new SalaryResource($salary);
        }

        throw new NotDoneException('Не удалось сохранить');
    }
}
