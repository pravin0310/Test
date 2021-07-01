<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Employee extends Model
{
    use HasFactory;

    protected $fillable= ['employee_id','employee_name','employee_department','employee_age','employee_experience','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
        // OR return $this->belongsTo('App\User');
    }
    public function setNameAttribute($value)
    {
         $this->attributes['employee_name']=ucfirst($value);
    }
}
