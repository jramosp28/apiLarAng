<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'name',
        'last_name',
        'last_name2',
        'email',
        'phone',
        'address',
        'city',
        'date',
        'bike',
        'bike_model'
    ];

    // protected $casts = [
    //     'date' => 'date'
    // ];
}