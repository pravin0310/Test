<?php

namespace App\Imports;

use App\Models\Employee;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeeImport implements ToModel, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // use Importable;
    private $rows = 0;
    public function model(array $row)
    {
       
        

        ++$this->rows;
        
   
        return new Employee([
            'employee_id'=>$row[0],
            'employee_name'=>$row[1],
            'employee_department'=>$row[2],
            'employee_age'=>$row[3],
            'employee_experience'=>$row[4],
            'userid'=>$row[5],
        ]);
       
    }
    public function getRowCount(): int
    {
        return $this->rows;
    }
   
    public function rules(): array
    {
        return [
            'maximum' => 'gte:*.minimum',
        ];
    }
}
