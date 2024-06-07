<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaseLine extends Model
{
    use HasFactory;
    protected $table = 'lease_line_provider';
    protected $fillable = [
        'id',
        'lease_line_provider'
    ];
    
}
