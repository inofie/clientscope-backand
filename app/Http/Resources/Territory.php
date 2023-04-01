<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\URL;

class Territory extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'creator_user_id' => $this->creator_user_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'color' => $this->color,
            'geofence_detail' => $this->geofence_detail,
            'status_id' => $this->status_id,
            'center_point' => $this->center_point,
            'universe' => $this->universe,
            'created_at' => $this->created_at,
            'creator_user' => $this->whenLoaded('creatorUser'),
            'assignee_user' => $this->whenLoaded('assigneeUser'),
            'pin_status' => $this->pinStatus
        ];
    }
}
