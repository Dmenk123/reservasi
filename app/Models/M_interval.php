<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class M_interval extends Model
{
    use SoftDeletes;
    public $incrementing = false;
    protected $table = "m_interval";
    protected $primaryKey = "id_m_interval";
    protected $dates = ['deleted_at'];


    protected $fillable = ['durasi_m_interval'];

    /* fungsi untuk menjalankan event ketika melakukan 'creating' pada model */
    protected static function boot()
    {
        parent::boot();

        M_interval::creating(function($model) {
            $model->id_m_interval = M_interval::max('id_m_interval') + 1;
        });
    }


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max($this->primaryKey)+1;
    }
}
