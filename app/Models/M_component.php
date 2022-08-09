<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_component extends Model
{
    protected $table = "m_component";
    protected $primaryKey = "id_m_component";

    protected $fillable = ['open_tag_m_component', 'close_tag_m_component', 'nm_m_component', 'default_style_m_component', 'created_at'];

    const ID_M_COMPONENT_HEADING1 = 1;
    const ID_M_COMPONENT_HEADING2 = 2;
    const ID_M_COMPONENT_HEADING3 = 3;
    const ID_M_COMPONENT_TEXT = 4;
    const ID_M_COMPONENT_IMAGE = 5;
    const ID_M_COMPONENT_LABEL = 6;
    const ID_M_COMPONENT_QUOTE = 7;
    const ID_M_COMPONENT_CODE = 8;
    const ID_M_COMPONENT_VIDEO = 9;

    /* fungsi untuk menjalankan event ketika melakukan 'creating' pada model */
    protected static function boot()
    {
        parent::boot();

        M_component::creating(function($model) {
            $model->id_m_component = M_app::max('id_m_component') + 1;
        });
    }
    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max('id_m_component')+1;
    }

}
