<?php

namespace App\Http\Resources\Product;

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
        //return parent::toArray($request);
        return [
            'name'          =>  $this->name,
            'description'   =>  $this->detail,
            'price'         =>  $this->price,
            'stock'         =>  $this->stock==0?'Out of stock':$this->stock,
            'totalPrice'    =>  round((1-($this->discount/100))*$this->price,2),
            'discount'      =>  $this->discount,
            'rating'        =>  ($this->review()->count()>0)?($this->review()->sum('star')/$this->review()->count('star')):'No Rating Yat',
            'href' => [
                'link'=> route('reviews.index',$this->id)
            ]
        ];
    }
}
