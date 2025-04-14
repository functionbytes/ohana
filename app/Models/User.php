<?php

namespace App\Models;

use App\Jobs\ImportBlacklistJob;
use App\Traits\HasCache;
use App\Traits\HasUid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens , LogsActivity , HasRoles , HasCache ,HasUid;

    protected $table = 'users';
    protected $quotaTracker;
    protected static $recordEvents = ['deleted','updated','created'];

    protected $fillable = [
        'uid',
        'firstname',
        'lastname',
        'cellphone',
        'email',
        'password',
        'available',
        'email_verified_at',
        'remember_token',
        'timezone',
        'verified',
        'last_login_at',
        'last_login_ip',
        'last_logins_at',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $dates = [
        'last_login_at',
        'deleted_at'
    ];

    protected $appends = ['full_name', 'image'];
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $casts = [
        'active' => 'boolean',
        'confirmed' => 'boolean',
    ];

    public function getActivitylogOptions(): LogOptions
    {

        return LogOptions::defaults()->logOnlyDirty()->logFillable()->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}");

    }

    public function scopeAvailable($query)
    {
        return $query->where('users.available', 1);
    }

    public function redirect()
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->hasRole('manager')) {
            return redirect()->route('manager.dashboard');
        }

        if ($user->hasRole('teleoperator')) {
            return redirect()->route('teleoperator.dashboard');
        }

        if ($user->hasRole('commercial')) {
            return redirect()->route('commercial.dashboard');
        }

        if ($user->hasRole('chiefteleoperator')) {
            return redirect()->route('chiefteleoperator.dashboard');
        }

        return redirect()->route('login');
    }

    public function sessions(): HasMany
    {
        return $this->hasMany('App\Models\Setting\Session','user_id');
    }

    public static function auth(){

        return Auth::user();
    }

    public function session() : HasOne
    {
        return $this->hasOne('App\Models\Setting\Session');
    }

    public function scopeId($query ,$id)
    {
        return $query->where('id', $id)->first();
    }

    public function scopeUid($query ,$uid)
    {
        return $query->where('uid', $uid)->first();
    }

    public function scopeEmail($query ,$email)
    {
        return $query->where('email', $email)->first();
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }

    public function getFullteleoperatorAttribute()
    {
        $firstWord = ucfirst(strtolower(strtok($this->firstname, ' ')));
        $lastName = ucfirst(strtolower($this->lastname));

        return "{$firstWord} {$lastName}";
    }

    public function getImageAttribute()
    {
        return asset('images/default-user.png');
    }

    public function worksessions(): HasMany
    {
        return $this->hasMany('App\Models\Worksession', 'employee_id');
    }

}

