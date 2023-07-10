<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembersModel extends Model
{
    use HasFactory;
    use Search;
    protected $table = 'members';
    protected $guarded = [];
    protected $searchable = [
        'membership_number', 'first_name',  'last_name', 'mobile_phone_number'

    ];
}