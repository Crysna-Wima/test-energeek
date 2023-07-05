<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillSets extends Model
{
    use HasFactory;
    protected $table = 'skill_sets';
    protected $primaryKey = ['job_id', 'skill_id'];
    protected $fillable = [
        'job_id',
        'skill_id',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // relasi many to many dengan table candidates
    public function candidates()
    {
        return $this->belongsToMany(Candidates::class, 'skill_sets', 'candidate_id', 'skill_id');
    }

    // relasi many to many dengan table skills
    public function skills()
    {
        return $this->belongsToMany(Skills::class, 'skill_sets', 'skill_id', 'candidate_id');
    }
}
