<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_states extends Model
{
    protected $table = "states";
    protected $primaryKey = "id";


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max('id')+1;
    }

}
