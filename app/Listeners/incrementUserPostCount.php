<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\PostCreated;
class incrementUserPostCount
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostCreated $event): void
    {
        $user = $event ->post->user;
        $user->post_count++;
        $user->save();
    }
}
