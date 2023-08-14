<?php

namespace Pterodactyl\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendPasswordReset extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public string $token)
    {
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(mixed $notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject('重設密碼')
            ->line('您收到此電子郵件是因為我們收到了您帳戶的重設密碼請求。')
            ->action('重設密碼', url('/auth/password/reset/' . $this->token . '?email=' . urlencode($notifiable->email)))
            ->line('如果您未請求重設密碼，則無需進一步操作。');
    }
}
