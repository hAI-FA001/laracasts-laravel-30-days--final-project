<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Job extends Model
{
    /** @use HasFactory<\Database\Factories\JobFactory> */
    use HasFactory;

    public function employer(): BelongsTo {
        return $this->belongsTo(Employer::class);
    }

    public function tag(string $name) {
        $tag = Tag::firstOrCreate(['name' => $name]);
        $this->tags()->attach($tag);
        // at this point, test tells u what to do next: add [name] to fillable
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
}
