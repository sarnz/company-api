<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function revenue()
    {
        return $this->hasMany(Company_total::class,'company_id','id');

    }
}
