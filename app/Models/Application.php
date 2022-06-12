<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'entrence_year',
        'graduation_year',
        'cum',
        'graduation_date',
        'high_school_title',
        'birth_certificate',
        'paes',
        'health_certificate',
        'specialization_id',
        'degree_id',
        'applicant_id',
    
    ];
    
    
    protected $dates = [
        'entrence_year',
        'graduation_year',
        'graduation_date',
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/applications/'.$this->getKey());
    }
}
