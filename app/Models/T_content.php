<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class T_content extends Model
{
    public $incrementing = false;
    protected $table = "t_content";
    protected $primaryKey = "id_t_content";


    protected $fillable = ['id_m_app', 'id_m_user_group', 'id_m_menu', 'id_m_user_bo', 'title_t_content', 'subtitle_t_content', 'is_active_t_content', 'created_at'];

    /* fungsi untuk menjalankan event ketika melakukan 'creating' pada model */
    protected static function boot()
    {
        parent::boot();

        T_content::creating(function($model) {
            $model->id_t_content = T_content::max('id_t_content') + 1;
        });
    }


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max($this->primaryKey)+1;
    }

    public function scopeIsActive($query)
    {
        return $query->where('is_active_t_content', 1);
    }

    public function m_app()
    {
        return $this->belongsTo(M_app::class, 'id_m_app', 'id_m_app');
    }

    public function m_menu()
    {
        return $this->belongsTo(M_menu::class, 'id_m_menu', 'id_m_menu');
    }

    public function t_content_det()
    {
        return $this->hasMany(T_content_det::class, 'id_t_content', 'id_t_content');
    }

    public function m_user_group()
    {
        return $this->belongsToMany(M_user_group::class, 't_group_content', 'id_t_content', 'id_m_user_group');
    }


    // public function m_user_group()
    // {
    //     return $this->hasMany(M_user_group::class, 'foreign_key', 'local_key');
    // }

}
