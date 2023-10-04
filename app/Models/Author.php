<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    use HasFactory;
    protected static $unguarded = true;
    public function research(): BelongsToMany
    {
        return $this->belongsToMany(Research::class, 'author_research');
    }
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    protected $casts = [
        'date_of_birth' => 'date:Y-m-d',
        'date_of_original_appointment' => 'date:Y-m-d',
    ];
    public function scopeSearch($query, $value)
    {
        $query
            ->where('name', 'like', "%{$value}%");
    }
}
