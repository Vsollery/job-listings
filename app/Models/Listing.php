<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters)
    {
        if ($filters['tags'] ?? null) {
            $query->where('tags', 'like', '%' . request('tags') . '%');
        }

        if ($filters['search'] ?? null) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }

    //protected $fillable = ['title', 'company', 'location', 'website', 'email', 'description', 'tags'];
}
