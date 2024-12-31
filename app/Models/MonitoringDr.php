<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonitoringDr extends Model
{
    protected $table = 'monitoring_drs';
    protected $primaryKey = 'id_dr';
    protected $guarded = [];
}
