<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class T_pembayaran extends Model
{
    use SoftDeletes;
    public $incrementing = false;
    protected $table = "t_pembayaran";
    protected $primaryKey = "id_t_pembayaran";
    protected $dates = ['deleted_at'];

    protected $fillable = ['id_t_reservasi', 'nilai_t_pembayaran', 'jenis_t_pembayaran', 'balance_t_pembayaran', 'nominal_cicilan_t_pembayaran', 'durasi_cicilan_t_pembayaran', 'cicilan_ke_t_pembayaran', 'nominal_total_t_pembayaran', 'tgl_pelunasan_t_pembayaran'];

    /* fungsi untuk menjalankan event ketika melakukan 'creating' pada model */
    protected static function boot()
    {
        parent::boot();

        T_pembayaran::creating(function($model) {
            $model->id_t_pembayaran = T_pembayaran::max('id_t_pembayaran') + 1;
        });
    }


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max($this->primaryKey)+1;
    }

    public function t_pembayaran_det()
    {
        return $this->hasMany(t_pembayaran_det::class, 'id_t_pembayaran', 'id_t_pembayaran');
    }

    public function t_reservasi()
    {
        return $this->belongsTo(T_reservasi::class, 'id_t_reserasi', 'id_t_reserasi');
    }
}
