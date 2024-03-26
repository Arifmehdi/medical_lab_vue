<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use HasApiTokens;
    // use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * roles relationship
     *
     * @var array
     */

    public function roles()
    {
        return $this->hasMany(UserRole::class,'user_id','id');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "User was {$eventName}";
    }
    // public function getActivitylogOptions(): LogOptions
    // {
    //     $logOptions = new LogOptions();

    //     // Customize log options as needed
    //     $logOptions->logName = 'user_activities';

    //     return $logOptions;
    // }
}
