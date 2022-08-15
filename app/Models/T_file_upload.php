<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class T_file_upload extends Model
{
    use SoftDeletes;
    public $incrementing = false;
    protected $table = "t_file_upload";
    protected $primaryKey = "id_t_file_upload";
    protected $dates = ['deleted_at'];


    protected $fillable = ['id_t_reservasi', 'path_t_file_upload', 'mimetype'];

    /* fungsi untuk menjalankan event ketika melakukan 'creating' pada model */
    protected static function boot()
    {
        parent::boot();

        T_file_upload::creating(function($model) {
            $model->id_t_file_upload = T_file_upload::max('id_t_file_upload') + 1;
        });
    }


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max($this->primaryKey)+1;
    }

}
