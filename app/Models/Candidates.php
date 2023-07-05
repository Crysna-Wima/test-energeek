<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidates extends Model
{
    use HasFactory;
    protected $table = 'candidates';
    protected $primaryKey = 'id';
    protected $fillable = [
        'job_id',
        'name',
        'email',
        'phone',
        'year',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // relasi many to one dengan table jobs
    public function jobs()
    {
        return $this->belongsTo(Jobs::class, 'job_id');
    }

    // relasi many to many dengan table skill_sets
    public function skillSets()
    {
        return $this->belongsToMany(Skills::class, 'skill_sets', 'candidate_id', 'skill_id');
    }


}
