<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'category' => new CategoryResource($this->category),
            'description' => $this->description,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'status' => ucfirst($this->status),
            'receipt' => $this->receipt,
            'created_at' => (new Carbon($this->created_at))->format('Y-m-d')
        ];
    }
}
