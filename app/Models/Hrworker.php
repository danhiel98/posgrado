<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hrworker extends Model
{
    protected $fillable = [
        'name',
        'birth_date',
        'phone_number',
        'address',
        'dui',
    
    ];
    
    
    protected $dates = [
        'birth_date',
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/hrworkers/'.$this->getKey());
    }
}
