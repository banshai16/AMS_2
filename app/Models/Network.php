<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    use HasFactory;
    protected $table = 'network';

    protected $fillable =
    [
        'id',
        'dept_name',
        'bandwidth',
        'dept_nodal_person',
        'link_type',
        'date_of_commissioning',
        'no_of_segments',
        'vlan_id',
        'no_of_ip',
        'ip_range',
        'latitude',
        'longitude',
        'router_model',
        'ownership_of_router',
        'lease_line_provider',
        'created_at',
        'updated_at',
    ];
}
