<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class T_reservasi_det extends Model
{
    use SoftDeletes;
    public $incrementing = false;
    protected $table = "t_reservasi_det";
    protected $primaryKey = "id_t_reservasi_det";
    protected $dates = ['deleted_at'];

    public const UPLOAD_DIR = 'uploads/bukti_transfer';

    public const MEDIUM = '312x400';
	public const SMALL = '135x75';


    // protected $fillable = ['nm_t_reservasi', 'email_t_reservasi', 'kode_t_reservasi', 'telp_t_reservasi', 'id_m_proses', 'hari_t_reservasi', 'jenis_t_reservasi', 'metode_pembayaran_t_reservasi', 'kode_payment_t_reservasi'];

    /* fungsi untuk menjalankan event ketika melakukan 'creating' pada model */
  
}
