<?php

namespace App\Http\Resources;

use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApprovalResource extends JsonResource
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
            'expense' => new ExpenseResource($this->expense),
            'approver' => new UserResource($this->approver),
            'status' => ucfirst($this->status),
            'comment' => $this->comment,
            'approved_at' => (new Carbon($this->updated_at))->format('Y-m-d')
        ];
    }
}
