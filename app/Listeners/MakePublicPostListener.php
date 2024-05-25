<?php

namespace App\Listeners;

use App\Events\SharePostEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MakePublicPostListener
{
    public function __construct(){}

    public function handle(SharePostEvent $event): void
    {
        
    }
}
