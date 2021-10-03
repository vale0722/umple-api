<?php

namespace App\Models;

use App\Models\Concerns\PostRelationship;
use App\Models\Concerns\Repositories\InteractionRepository;
use App\Models\Concerns\UserRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interaction extends Model
{
    use HasFactory;
    use UserRelationship;
    use PostRelationship;
    use InteractionRepository;

    protected $fillable = [
      'user_id'
    ];

    public function getType() {
        return $this->type;
    }
}
