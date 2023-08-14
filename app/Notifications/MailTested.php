<?php

namespace Pterodactyl\Notifications;

use Pterodactyl\Models\User;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class MailTested extends Notification
{
    public function __construct(private User $user)
    {
    }

    public function via(): array
    {
        return ['mail'];
    }

    public function toMail(): MailMessage
    {
        return (new MailMessage())
            ->subject('Pterodactyl 測試郵件')
            ->greeting('您好 ' . $this->user->name . '！')
            ->line('這是 Pterodactyl 郵件系統的測試。如果您收到這個代表一切正常！');
    }
}
