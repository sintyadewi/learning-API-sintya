<?php

namespace App\Http\Resources\API\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return [
        //     'id'       => $this->id,
        //     'name'     => $this->firstname.$this->lastname,
        //     'email'    => $this->email,
        //     'password' => $this->password,
        // ];
        return parent::toArray($request);
    }
}
