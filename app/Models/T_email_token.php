<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class T_email_token extends Model
{
    use SoftDeletes;
    public $incrementing = false;
    protected $table = "t_email_token";
    protected $primaryKey = "id_t_email_token";
    protected $dates = ['deleted_at'];

    protected $fillable = ['id_t_reservasi', 'email', 'token', 'expired_at'];

    /* fungsi untuk menjalankan event ketika melakukan 'creating' pada model */
    protected static function boot()
    {
        parent::boot();

        T_email_token::creating(function($model) {
            $model->id_t_email_token = T_email_token::max('id_t_email_token') + 1;
        });
    }


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max($this->primaryKey)+1;
    }
}
