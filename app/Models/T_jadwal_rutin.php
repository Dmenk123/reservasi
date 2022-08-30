<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class T_jadwal_rutin extends Model
{
    use SoftDeletes;
    public $incrementing = false;
    protected $table = "t_jadwal_rutin";
    protected $primaryKey = "id_t_jadwal_rutin";
    protected $dates = ['deleted_at'];

    protected $fillable = ['urut', 'hari', 'status'];

    ##### LOG ACTIVITY ####
    use LogsActivity;
    protected static $submitEmptyLogs = false;
    protected static $logName = 't_jadwal_rutin';
    protected static $logFillable = true;
    // protected static $logUnguarded = true;

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} by : " . session()->get('logged_in.nm_user');
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->causer_id = session()->get('logged_in.id_m_user_bo');
    }
    ##### END LOG ACTIVITY ####

    /* fungsi untuk menjalankan event ketika melakukan 'creating' pada model */
    protected static function boot()
    {
        parent::boot();

        T_jadwal_rutin::creating(function($model) {
            $model->id_t_jadwal_rutin = T_jadwal_rutin::max('id_t_jadwal_rutin') + 1;
        });
    }


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max($this->primaryKey)+1;
    }

    public function t_jadwal_rutin_det()
    {
        return $this->hasMany(t_jadwal_rutin_det::class, 'id_t_jadwal_rutin', 'id_t_jadwal_rutin');
    }
}
