<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyFormResource extends JsonResource
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
            'company_name' => $this->company_name,
            'industry' => $this->industry,
            'employees' => $this->employees,
            'stage' => $this->stage,
            'skills' => $this->skills,
            'home_workers' => $this->home_workers,
            'training'  => $this->training,
            'hiring' => $this->hiring,
            'remote_hiring_preferences' => $this->remote_hiring_preferences,
            'additional_notes' => $this->additional_notes,
            'user_profile' => new UserProfileResource($this->user->profile), // Include user profile using a separate resource
        ];
    }
}
