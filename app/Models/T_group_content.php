<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class T_group_content extends Model
{
    public $incrementing = false;
    protected $table = "t_group_content";
    protected $primaryKey = "id_t_group_content";


    protected $fillable = ['id_t_group_content', 'id_t_content', 'id_m_user_group', 'created_at'];

    /* fungsi untuk menjalankan event ketika melakukan 'creating' pada model */
    protected static function boot()
    {
        parent::boot();

        T_group_content::creating(function($model) {
            $model->id_t_group_content = T_group_content::max('id_t_group_content') + 1;
        });
    }

    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max($this->primaryKey)+1;
    }

}
