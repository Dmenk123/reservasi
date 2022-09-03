<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class M_harga extends Model
{
    use SoftDeletes;
    protected $table = "m_harga";
    protected $primaryKey = "id_m_harga";
    protected $dates = ['deleted_at'];

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

    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max('id_m_harga')+1;
    }

    public function scopeActive($query)
    {
        return $query->where('status_m_harga', 1);
    }

}
