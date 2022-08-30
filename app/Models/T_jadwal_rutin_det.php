<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class T_jadwal_rutin_det extends Model
{
    use SoftDeletes;
    public $incrementing = false;
    protected $table = "t_jadwal_rutin_det";
    protected $primaryKey = "id_t_jadwal_rutin_det";
    protected $dates = ['deleted_at'];

    protected $fillable = ['id_t_jadwal_rutin', 'sesi', 'pukul'];

    ##### LOG ACTIVITY ####
    use LogsActivity;
    protected static $submitEmptyLogs = false;
    protected static $logName = 't_jadwal_rutin_det';
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

        T_jadwal_rutin_det::creating(function($model) {
            $model->id_t_jadwal_rutin_det = T_jadwal_rutin_det::max('id_t_jadwal_rutin_det') + 1;
        });
    }


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max($this->primaryKey)+1;
    }

    public function t_jadwal_rutin()
    {
        return $this->belongsTo(t_jadwal_rutin::class, 'id_t_jadwal_rutin', 'id_t_jadwal_rutin');
    }
}
