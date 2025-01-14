<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email' => $this->user->email,
            'user_id' => $this->user_id,
            'username' => $this->user->name, // Include the related user's name
            'phone_number' => $this->phone_number,
            'country' => $this->country,
            'city' => $this->city,
            'address' => $this->address,
            'birth_date' => $this->birth_date,
            'status' => $this->user->status,
            'created_at' => $this->created_at,
            // 'user_type' => $this->user->role->name,
        ];
    }
}
