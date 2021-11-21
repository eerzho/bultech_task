<?php

namespace App\Models\SalaryCalculate;

use App\Components\DateFormat\DateFormatHelper;
use App\Models\BaseModel\BaseModel;
use App\Models\Salary\Salary;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int         $salary_id
 * @property double      $clean_salary Оклад с вычетом всех налогов
 * @property double      $opv          Обязательные пенсионные взносы
 * @property double      $vosms        Взносы на обязательное социальное медицинское Страхование
 * @property double      $osms         Обязательное социальное медицинское страхование
 * @property double      $co           Социальные отчисления
 * @property double      $ipn          Индивидуальный подоходный налог
 * @property-read Salary $salary
 */
class SalaryCalculate extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'salary_id',
        'clean_salary',
        'opv',
        'vosms',
        'osms',
        'co',
        'ipn',
    ];

    protected $casts = [
        'clean_salary' => 'double',
        'opv'          => 'double',
        'vosms'        => 'double',
        'osms'         => 'double',
        'co'           => 'double',
        'ipn'          => 'double',
        'created_at'   => DateFormatHelper::CAST_DATETIME_FORMAT,
        'updated_at'   => DateFormatHelper::CAST_DATETIME_FORMAT,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function salary()
    {
        return $this->belongsTo(Salary::class, 'salary_id');
    }
}
