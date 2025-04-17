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

    // User.php
    public function redirectRouteName()
    {
        return match (true) {
            $this->hasRole('manager') => 'manager.dashboard',
            $this->hasRole('teleoperator') => 'teleoperator.dashboard',
            $this->hasRole('commercial') => 'commercial.dashboard',
            $this->hasRole('chiefteleoperator') => 'chiefteleoperator.dashboard',
            default => 'login',
        };
    }


    public function redirect()
    {
        return redirect()->route($this->redirectRouteName());
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
        if (strlen($password) !== 60 || !preg_match('/^\$2y\$/', $password)) {
            $this->attributes['password'] = bcrypt($password);
        } else {
            $this->attributes['password'] = $password;
        }
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


    public function delegation() {
        return $this->belongsTo('App\Models\Delegation\Delegation');
    }

    public function location() {
        return $this->belongsTo('App\Models\Location\Location');
    }

    public function role() {
        return $this->belongsTo('App\Models\Role');
    }

    public function notes() {
        return $this->hasMany('App\Models\Note\Note');
    }

    public function statements() {
        return $this->hasMany('App\Models\Statement\Statement');
    }

    public function contracts() {
        return $this->hasMany('App\Models\Contract\Commission');
    }

    public function commissions()
    {
        return $this->morphMany('App\Models\Commission\Commission', 'commissionable');
    }

}

