<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UchumiNonMatching extends Model
{
    use HasFactory;
    protected $table = 'uchumi_transactions_non_matching';
    protected $guarded = [];
}
