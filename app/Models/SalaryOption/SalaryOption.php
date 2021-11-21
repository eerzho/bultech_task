<?php

namespace App\Models\SalaryOption;

use App\Components\DateFormat\DateFormatHelper;
use App\Models\BaseModel\BaseModel;
use App\Models\Salary\Salary;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int         $salary_id
 * @property boolean     $is_invalid    Является ли сотрудник инвалидом
 * @property int         $invalid_group Группа инвалидности
 * @property boolean     $is_retired    Является ли сотрудник пенсионером
 * @property-read Salary $salary
 */
class SalaryOption extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'salary_id',
        'is_invalid',
        'invalid_group',
        'is_retired',
    ];

    protected $casts = [
        'is_invalid' => 'boolean',
        'is_retired' => 'boolean',
        'created_at' => DateFormatHelper::CAST_DATETIME_FORMAT,
        'updated_at' => DateFormatHelper::CAST_DATETIME_FORMAT,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function salary()
    {
        return $this->belongsTo(Salary::class, 'salary_id');
    }
}
