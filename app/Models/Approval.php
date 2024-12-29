<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    //
    protected $fillable = ['expense_id', 'approver_id', 'status', 'comment'];

    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $value)
    {
        $query->whereHas('expense.category', function ($q) use ($value) {
            $q->where('name', 'like', '%' . $value . '%');
        })
            ->orWherehas('expense.user', function ($q) use ($value) {
                $q->where('name', 'like', '%' . $value . '%')
                    ->orWhere('email', 'like', '%' . $value . '%');
            })
            ->orWherehas('approver', function ($q) use ($value) {
                $q->where('name', 'like', '%' . $value . '%')
                    ->orWhere('email', 'like', '%' . $value . '%');
            });
    }
}
