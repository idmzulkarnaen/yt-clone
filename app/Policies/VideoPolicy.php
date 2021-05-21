<?php

namespace App\Policies;

use App\Models\Video;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user, Video $video)
    {


        return $user->id === $video->channel->user_id;
    }
}
