<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    //
    protected $fillable = ['category_id', 'limit', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
