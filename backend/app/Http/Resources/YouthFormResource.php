<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class YouthFormResource extends JsonResource
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
            'gender' => $this->gender,
            'is_it_graduate' => $this->is_it_graduate,
            'job_interest' => $this->job_interest,
            'motivation' => $this->motivation,
            'career_goals' => $this->career_goals,
            'project_ideas' => $this->project_ideas,
            'has_workshops' => $this->has_workshops,
            'workshop_clarify' => $this->workshop_clarify,
            'has_coding_experience' => $this->has_coding_experience,
            'coding_clarify' => $this->coding_clarify,
            'knows_other_languages' => $this->knows_other_languages,
            'languages' => $this->languages,
            'creative_problem_solving' => $this->creative_problem_solving,
            'website_vs_webapp' => $this->website_vs_webapp,
            'usability_steps' => $this->usability_steps,
            'additional_info' => $this->additional_info,
            'document' => $this->document,
            'user_profile' => new UserProfileResource($this->user->profile), // Include user profile using a separate resource
        ];
    }
}
