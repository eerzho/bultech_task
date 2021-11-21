<?php

namespace App\Models\Salary;

use App\Components\DateFormat\DateFormatHelper;
use App\Models\BaseModel\BaseModel;
use App\Models\SalaryCalculate\SalaryCalculate;
use App\Models\SalaryOption\SalaryOption;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property double               $salary             Оклад
 * @property int                  $work_days          Норма дней в месяц
 * @property int                  $complete_work_days Отработанное количество дней
 * @property int                  $year               Календарный год
 * @property int                  $month              Календарный месяц
 * @property-read SalaryOption    $option
 * @property-read SalaryCalculate $calculate
 */
class Salary extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'salary',
        'work_days',
        'complete_work_days',
        'year',
        'month',
    ];

    protected $casts = [
        'salary' => 'double',
        'created_at' => DateFormatHelper::CAST_DATETIME_FORMAT,
        'updated_at' => DateFormatHelper::CAST_DATETIME_FORMAT,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function option()
    {
        return $this->hasOne(SalaryOption::class, 'salary_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function calculate()
    {
        return $this->hasOne(SalaryCalculate::class, 'salary_id');
    }
}
