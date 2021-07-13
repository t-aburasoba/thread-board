<?php

namespace App\Services;

use App\Notifications\SlackNotification;
use Illuminate\Notifications\Notifiable;

class SlackNotificationService
{
    use Notifiable;
    
    public function send($message)
    {
        $this->notify(new SlackNotification($message));
    }

    /**
     * Slackチャンネルに対する通知をルートする
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForSlack($notification)
    {
        return config('app.slack_url');
    }
}
