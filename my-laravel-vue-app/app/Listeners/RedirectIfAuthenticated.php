<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RedirectIfAuthenticated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Authenticated $event)
    {
        // Redirect based on user role
    if ($event->user->role === 'admin') {
        return redirect()->route('admin.index'); // Change this to your admin route
    } elseif ($event->user->role === 'teacher') {
        return redirect()->route('teachers.index'); // Change this to your teacher route
    } elseif ($event->user->role === 'student') {
        return redirect()->route('students.index'); // Change this to your student route
    }
    }
}