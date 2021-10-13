<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class CategoryResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'group_id'      => $this->group_id,
            'name'          => $this->name,
            'slug'          => $this->slug,
            'icon'          => $this->icon,
            'category_code' => $this->category_code,
            'serial_no'     => $this->serial_no,
            'short_details' => $this->short_details,
            'status'        => $this->status,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
