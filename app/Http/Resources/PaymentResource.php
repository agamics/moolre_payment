<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'domain' => $this->domain,
            'status' => $this->status,
            'reference' => $this->reference,
            'amount' => $this->amount,
            'nullable' => $this->nullable,
            'gateway_response' => $this->gateway_response,
            'paid_at' => $this->paid_at,
            'created_at' => $this->created_at,
            'channel' => $this->channel,
            'currency' => $this->currency,
            'ip_address' => $this->ip_address,
            'fees' => $this->fees,
        ];
    }
}
