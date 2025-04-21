<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        
        return [
            'customer_id' =>$this-> customer_id,
            'amount' => $this->amount,
            'status' => $this->status,
            'billed_date' => $this->billed_date,
            'paid_date' => $this->paid_date
        ];
}
}