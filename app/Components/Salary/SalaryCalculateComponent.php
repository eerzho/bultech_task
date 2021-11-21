<?php

namespace App\Components\Salary;

use App\Components\Request\DataTransfer;

/**
 * @property DataTransfer $data
 * @property int          $salary
 * @property float        $opv
 * @property float        $vosms
 * @property float        $osms
 * @property float        $co
 * @property float        $ipn
 */
class SalaryCalculateComponent
{
    const MZP = 42500;
    const MRP = 2917;

    private DataTransfer $data;
    private $salary;
    private $opv;
    private $vosms;
    private $osms;
    private $co;
    private $ipn;

    /**
     * @param DataTransfer $data
     */
    public function __construct(DataTransfer $data)
    {
        $this->data = $data;
    }

    /**
     * @return int
     */
    public function getSalary()
    {
        return $this->salary ?: $this->salary = $this->data->get('salary');
    }

    /**
     * @return float
     */
    public function getOPV(): float
    {
        return $this->opv ?: $this->opv = ($this->getSalary() * 0.1);
    }

    /**
     * @return float
     */
    public function getVOSMS(): float
    {
        return $this->vosms ?: $this->vosms = ($this->getSalary() * 0.02);
    }

    /**
     * @return float
     */
    public function getOSMS()
    {
        return $this->osms ?: $this->osms = ($this->getSalary() * 0.02);
    }

    /**
     * @return float
     */
    public function getCO()
    {
        return $this->co ?: $this->co = (($this->getSalary() - $this->getOPV()) * 0.035);
    }

    /**
     * @return float
     */
    public function getIPN()
    {
        $res = $this->getSalary() - $this->getOPV() - self::MZP;

        $res = $res * ($this->getSalary() < 25 * self::MRP ? 0.9 : 0.1);

        return $this->ipn ?: $this->ipn = $res;
    }

    /**
     * @return array
     */
    public function calculate()
    {
        $res['salary'] = $this->getSalary();
        $res['clean_salary'] = $this->getSalary();

        if ($this->data->get('is_retired') && $this->data->get('is_invalid')) {

            return $res;

        } elseif ($this->data->get('is_retired')) {

            $res['ipn'] = $this->getIPN();
            $res['clean_salary'] -= $res['ipn'];

            return $res;

        } elseif ($this->data->get('is_invalid')) {

            if ($this->getSalary() > 882 * self::MRP) {

                $res['ipn'] = $this->getIPN();
                $res['clean_salary'] = $res['ipn'];

                return $res;

            } elseif (in_array($this->data->get('invalid_group'), [1, 2])) {

                $res['co'] = $this->getCO();
                $res['clean_salary'] -= $res['co'];

                return $res;

            } elseif ($this->data->get('invalid_group') == 3) {

                $res['opv'] = $this->getOPV();
                $res['co'] = $this->getCO();
                $res['clean_salary'] -= $res['opv'];
                $res['clean_salary'] -= $res['co'];

                return $res;
            }
        }

        $res['opv'] = $this->getOPV();
        $res['ipn'] = $this->getIPN();
        $res['vosms'] = $this->getVOSMS();
        $res['clean_salary'] -= $res['opv'];
        $res['clean_salary'] -= $res['ipn'];
        $res['clean_salary'] -= $res['vosms'];

        return $res;
    }
}
