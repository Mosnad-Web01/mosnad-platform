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
            'user_id' => $this->user_id,
            'username' => $this->user->name, // Include the related user's name
            'phone_number' => $this->phone_number,
            'country' => $this->country,
            'city' => $this->city,
            'address' => $this->address,
            'birth_date' => $this->birth_date,
            'user_type' => $this->user_type,
        ];
    }
}
