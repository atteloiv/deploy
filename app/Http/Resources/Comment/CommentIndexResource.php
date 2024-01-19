<?php

namespace App\Http\Resources\Comment;

use App\Http\Resources\Post\PostIndexResource;
use App\Http\Resources\Tag\TagResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'message' => $this->message,
            'created_at' => $this->created_at,
            'user' => new UserResource($this->user),
            //'user1' => UserResource::collection($this->users),
        ];
    }
}
