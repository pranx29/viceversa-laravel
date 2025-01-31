<?php

namespace App\Models;
use MongoDB\Laravel\Eloquent\Model;

class ApiLog extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'api_logs';

    protected $fillable = [
        'endpoint',
        'method',
        'user_id',
        'request',
        'response',
        'status_code',
        'execution_time',
        'ip_address',
        'user_agent'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
