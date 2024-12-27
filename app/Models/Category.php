<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['name', 'description'];

    public function expense()
    {
        return $this->hasMany(Expense::class);
    }

    public function scopeSearch($query, $value)
    {
        $query->where('name', 'like', '%' . $value . '%');
    }
}
