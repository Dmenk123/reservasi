<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class T_reservasi extends Model
{
    use SoftDeletes;
    public $incrementing = false;
    protected $table = "t_reservasi";
    protected $primaryKey = "id_t_reservasi";
    protected $dates = ['deleted_at'];


    protected $fillable = ['nm_t_reservasi', 'email_t_reservasi', 'kode_t_reservasi', 'telp_t_reservasi', 'id_m_proses', 'hari_t_reservasi', 'jenis_t_reservasi', 'metode_pembayaran_t_reservasi', 'kode_payment_t_reservasi'];

    /* fungsi untuk menjalankan event ketika melakukan 'creating' pada model */
    protected static function boot()
    {
        parent::boot();

        T_reservasi::creating(function($model) {
            $model->id_t_reservasi = T_reservasi::max('id_t_reservasi') + 1;
        });
    }


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max($this->primaryKey)+1;
    }

    public function m_proses()
    {
        return $this->belongsTo(\App\Models\M_proses::class, 'id_m_proses', 'id_m_proses');
    }

    public function t_file_upload()
    {
        return $this->hasOne(\App\Models\T_file_upload::class, 'id_t_reservasi', 'id_t_reservasi');
    }

}
