<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company_total extends Model
{
    protected $table = 'company_total';
    public function company()
    {
        return $this->hasMany(Company::class,'company_id','id');
    }
    public function type()
    {
        return $this->belongsTo(Type::class,'type_id','id');
    }

}
