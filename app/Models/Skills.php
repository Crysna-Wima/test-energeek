<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    use HasFactory;

    protected $table = 'skills';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // relasi many to many dengan table skill_sets
    public function skillSets()
    {
        return $this->belongsToMany(Candidates::class, 'skill_sets', 'skill_id', 'candidate_id');
    }
    
}
