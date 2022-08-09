<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class T_content_det extends Model
{
    public $incrementing = false;
    protected $table = "t_content_det";
    protected $primaryKey = "id_t_content_det";


    protected $fillable = ['id_t_content', 'value_m_component', 'id_m_component', 'path_t_content_det'];

    /* fungsi untuk menjalankan event ketika melakukan 'creating' pada model */
    protected static function boot()
    {
        parent::boot();

        T_content_det::creating(function($model) {
            $model->id_t_content_det = T_content_det::max('id_t_content_det') + 1;
        });
    }


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max($this->primaryKey)+1;
    }

    public function scopeSortData($query)
    {
        return $query->max('sort_t_content_det')+1;
    }

    public function t_content()
    {
        return $this->belongsTo(T_content::class, 'id_t_content', 'id_t_content');
    }

    public function m_component()
    {
        return $this->belongsTo(M_component::class, 'id_m_component', 'id_m_component');
    }

}
