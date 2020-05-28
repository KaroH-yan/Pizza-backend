<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderCollection extends ResourceCollection
{
    public $with = ['status' => false];

    public $collects = 'App\Http\Resources\OrderResource';

    public function __construct($resource)
    {
        parent::__construct($resource);

        if ($resource->count() > 0) {
            $this->with['status'] = true;
        }
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
        ];
    }
}

