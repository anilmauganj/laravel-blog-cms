<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
      
    protected $fillable = [
    'category_id',
    'title',
    'slug',
    'excerpt',
    'content',
    'featured_image',
    'status',
    'published_at',
    'views',
    'seo_title',
    'meta_description',
  ];

  protected $casts = [
    'published_at' => 'datetime',
]  ;

  public function category() 
  {
    return $this->belongsTo(Category::class);
  }
}
