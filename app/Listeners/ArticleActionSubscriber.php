<?php

namespace App\Listeners;

use App\Events\ArticleCreatedEvent;
use App\Events\ArticleDeletedEvent;
use App\Events\ArticleUpdatedEvent;
use App\Mail\ArticleCreatedMail;
use App\Mail\ArticleDeletedMail;
use App\Mail\ArticleUpdatedMail;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ArticleActionSubscriber
{
    public function created(ArticleCreatedEvent $event): void
    {
        $this->sendNotification(new ArticleCreatedMail($event->article()));
    }

    public function updated(ArticleUpdatedEvent $event): void
    {
        $this->sendNotification(new ArticleUpdatedMail($event->article()));
    }

    public function deleted(ArticleDeletedEvent $event): void
    {
        $this->sendNotification(new ArticleDeletedMail($event->article()));
    }

    private function sendNotification(Mailable $mailable) : void
    {
        $adminEmail = config('auth.admin_credentials.email');
        if ($adminEmail) {
            Mail::to($adminEmail)->send($mailable);
        }
    }

    public function subscribe(Dispatcher $dispatcher): array
    {
        return [
            ArticleCreatedEvent::class => 'created',
            ArticleUpdatedEvent::class => 'updated',
            ArticleDeletedEvent::class => 'deleted'
        ];
    }
}
