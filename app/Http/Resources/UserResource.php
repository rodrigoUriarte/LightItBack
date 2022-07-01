<?php

namespace App\Http\Resources;

use App\Enums\GenderType;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'gender' => GenderType::from($this->gender)->name,
            'birthday' => $this->birthday,
            'email' => $this->email,
            'token' => $this->when($this->relationLoaded('token'), function () {
                return new TokenResource($this->token);
            }),
        ];
    }
}
