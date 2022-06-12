<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'dui',
        'student_id',
        'birth_date',
        'phone_number',
        'email',
    
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
        return url('/admin/applicants/'.$this->getKey());
    }
}
