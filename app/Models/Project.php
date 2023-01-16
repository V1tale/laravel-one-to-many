<?php

namespace App\Models;

// use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['type_id', 'title', 'content', 'slug', 'image'];


    public function category()
    {
        return $this->belongsTo(Type::class);
    }
    // public static function generateSlug($title)
    // {
    //     return Str::slug($title, '-');
    // }
}
