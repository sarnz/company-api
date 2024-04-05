<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function items()
    {
        return $this->hasMany(CompanyType::class,'type_id','id');
    }
}
