<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class GroupResource extends Resource
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
            'name'          => $this->name,
            'slug'          => $this->slug,
            'icon'          => $this->icon,
            'group_code'    => $this->group_code,
            'serial_no'     => $this->serial_no,
            'short_details' => $this->short_details,
            'status'        => $this->status,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
