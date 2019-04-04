<?php

namespace App\Policies;

use App\{Task, User};
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function owner(User $user, Task $task)
    {
        return $user->id == $task->user_id;
    }

}
