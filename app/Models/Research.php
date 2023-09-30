<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Research extends Model
{
    use HasFactory;
    protected static $unguarded = true;
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }
    public function scopeSearch($query, $value)
    {
        $query
            ->where('title', 'like', "%{$value}%")
            ->orWhereHas('author', function ($q) use ($value) {
                $q->where('name', 'like', "%{$value}%");
            });
    }
}
