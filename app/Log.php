<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected static function boot()
    {
        parent::boot();
    }
    protected $fillable = [
        'message','code','line'
    ];
    protected $primaryKey = 'id';
    protected $table = 'log';

}
