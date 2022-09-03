<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class T_pembayaran_det extends Model
{
    use SoftDeletes;
    public $incrementing = false;
    protected $table = "t_pembayaran_det";
    protected $primaryKey = "id_t_pembayaran_det";
    protected $dates = ['deleted_at'];

    protected $fillable = ['id_t_pembayaran', 'nominal_t_pembayaran_det', 'kode_konfirmasi', 'tgl_t_pembayaran_det', 'verified_at', 'verified_by'];

    /* fungsi untuk menjalankan event ketika melakukan 'creating' pada model */
    protected static function boot()
    {
        parent::boot();

        T_pembayaran_det::creating(function($model) {
            $model->id_t_pembayaran_det = T_pembayaran_det::max('id_t_pembayaran_det') + 1;
        });
    }


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max($this->primaryKey)+1;
    }

    public function t_pembayaran()
    {
        return $this->belongsTo(T_pembayaran::class, 'id_t_pembayaran', 'id_t_pembayaran');
    }
}
