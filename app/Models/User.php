<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user';

    protected $primaryKey = 'userid';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'email',
        'address',
        'display_name',
        'company_name',
        'phonenumber',
        'home_phone',
        'work_phone',
        'designation_id',
        'marital_status',
        'DOB',
        'dependents',
        'ownertype',
        'addres_notes',
        'contractor',
        'street',
        'gender',
        'emergency_phone',
        'unit',
        'country_id',
        'state_id',
        'city',
        'zipcode',
        'resume',
        'resume_file_name',
        'password',
        'status',
        'device_key',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function projects()
    {
        return $this->hasMany(ServiceMember::class, 'member_id');
    }

    public function  getMessageCount()
    {
        return  CountMSG($this->userid);
    }
}
