<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    //
    protected $fillable = ['category_id', 'limit', 'currency', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeSearch($query, $value)
    {
        $query->wherehas('category', function ($q) use ($value) {
            $q->where('name', 'like', '%' . $value . '%');
        });
    }
}
