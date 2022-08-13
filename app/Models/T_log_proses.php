<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class T_log_proses extends Model
{
    use SoftDeletes;
    public $incrementing = false;
    protected $table = "t_log_proses";
    protected $primaryKey = "id_t_log_proses";
    protected $dates = ['deleted_at'];

    protected $fillable = ['id_t_reservasi', 'id_m_proses'];

    /* fungsi untuk menjalankan event ketika melakukan 'creating' pada model */
    protected static function boot()
    {
        parent::boot();

        T_log_proses::creating(function($model) {
            $model->id_t_log_proses = T_log_proses::max('id_t_log_proses') + 1;
        });
    }


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max($this->primaryKey)+1;
    }
}
