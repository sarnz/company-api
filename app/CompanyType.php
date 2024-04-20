<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyType extends Model
{
    protected $table = 'company_types';
    public function company()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }
    
    public function revenue()
    {
        return $this->hasMany(Company_total::class,'type_id','id');

    }
}
