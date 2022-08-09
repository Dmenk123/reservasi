<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_module extends Model
{
    protected $table = "m_module";
    protected $primaryKey = "id_m_module";


    public function scopeMaxId($query)
    {
        return $query->max('id_m_module')+1;
    }

}
