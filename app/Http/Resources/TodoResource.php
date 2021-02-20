<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TodoResource extends JsonResource {

    public function toArray($request) {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'finished' => $this->finished
        ];
    }
}
