<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Article extends Model
{
    protected $guarded = [];
    use HasFactory, Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function media(){
        return $this->hasOne(ArticleMedia::class, 'article_id');
    }

}
