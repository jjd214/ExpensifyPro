<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    //
    protected $fillable = ['user_id', 'category_id', 'description', 'amount', 'currency', 'status', 'receipt'];

    protected $cast = [
        'amount' => 'float'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approval()
    {
        return $this->hasOne(Approval::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
