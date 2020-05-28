<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PizzaResource extends JsonResource
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
    public function toArray($request =false)
    {
        if ($this->with['status']) {

            return [
                'id' => $this->id,
                'name' => $this->name,
                'image' => $this->image,
                'prices' => PizzaPriceResource::collection($this->prices)
            ];

        }

        return [];
    }


}
