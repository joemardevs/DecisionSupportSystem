<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Research extends Model
{
    use HasFactory;
    protected static $unguarded = true;
    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'author_research')->withPivot('lead_author');
    }
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }
    protected $casts = [
        'date_presented' => 'date:Y-m-d',
        'date_complited' => 'date:Y-m-d',
        'date_issued' => 'date:Y-m-d',
    ];
    public function scopeSearch($query, $value)
    {
        $query
            ->where('title', 'like', "%{$value}%")
            ->orWhereHas('authors', function ($query) use ($value) {
                $query->where('name', 'like', "%{$value}%");
            });
    }
}
