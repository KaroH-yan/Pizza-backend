<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{

    public $with = ['status' => false];

    public function __construct($resource)
    {
        parent::__construct($resource);

        if ($resource) {
            $this->with['status'] = true;
        }
    }

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->with['status']) {
            return [
                'id' => $this->id,
                'address' => $this->address,
                'prices' => OrderPriceResource::collection($this->prices),
                'collections' => new OrderItemCollection($this->collections),
                'created_at' => $this->created_at->format('Y-m-d'),
                'status' => $this->status
            ];
        }
        return [];
    }
}
