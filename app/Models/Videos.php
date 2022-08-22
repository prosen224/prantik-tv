<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    use HasFactory;
    protected $table = 'videos';


    public function r_category()
    {
        return $this->belongsTo(Category::class,'category_id', 'id');
    }

    protected $fillable = [
        'title','slug', 'video_url', 'description', 'status', 'category_id', 'featured', 'thumb_image', 'banner_image'
    ];

    

}
