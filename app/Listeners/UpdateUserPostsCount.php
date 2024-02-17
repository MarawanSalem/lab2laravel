<?php

namespace App\Listeners;

use App\Events\PostCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateUserPostsCount
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    // app/Listeners/UpdateUserPostsCount.php

    public function handle(PostCreated $event)
    {
        $user = $event->post->user;
        $user->increment('posts_count');
    }


}
