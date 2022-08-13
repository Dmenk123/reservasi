<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class T_jadwal_rutin extends Model
{
    use SoftDeletes;
    public $incrementing = false;
    protected $table = "t_jadwal_rutin";
    protected $primaryKey = "id_t_jadwal_rutin";
    protected $dates = ['deleted_at'];

    protected $fillable = ['jam_mulai', 'jam_akhir', 'hari'];

    /* fungsi untuk menjalankan event ketika melakukan 'creating' pada model */
    protected static function boot()
    {
        parent::boot();

        T_jadwal_rutin::creating(function($model) {
            $model->id_t_jadwal_rutin = T_jadwal_rutin::max('id_t_jadwal_rutin') + 1;
        });
    }


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max($this->primaryKey)+1;
    }
}
