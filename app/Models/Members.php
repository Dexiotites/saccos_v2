<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    use HasFactory;
    use Search;

    protected $guarded = [];
    protected $searchable = [
        'membership_number', 'first_name',  'last_name', 'mobile_phone_number'

    ];
}
