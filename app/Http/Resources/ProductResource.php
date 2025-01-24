<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $statuses = config('products.statuses');
        return [
            'id' => $this->id,
            'article' => $this->article,
            'name' => $this->name,
            'status' => $statuses[$this->status]['title'],
            'data' => json_decode($this->data),
            'create_date' => $this->created_at->format('d.m.Y h:m:s'),
            'update_at' => $this->updated_at->format('d.m.Y h:m:s'),
        ];
    }
}
