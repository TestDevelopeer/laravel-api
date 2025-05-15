<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'category_id',
    ];

//    protected $hidden = [
//        'created_at',
//        'updated_at',
//    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
