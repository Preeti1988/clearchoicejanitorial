<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'email_address',
        'name',
        'mobile_number',
        'address',
        'display_name',
        'company_name',
        'mobile_number',
        'home_number',
        'client_work_number',
        'designation_id',
        'ownertype',
        'address_notes',
        'contractor',
        'street',
        'unit',
        'country_id',
        'state_id',
        'city',
        'zipcode',
        'client_notes',
        'client_tags',
        'client_bills_to',
        'lead_source',
        'status',
        'role',

        'created_at'
    ];
    protected $table = 'clients';
    protected $key = 'id';
    public $timestamps = false;

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
