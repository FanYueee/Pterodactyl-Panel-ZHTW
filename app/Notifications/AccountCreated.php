<?php

namespace Pterodactyl\Notifications;

use Pterodactyl\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AccountCreated extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public User $user, public ?string $token = null)
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
    public function toMail(): MailMessage
    {
        $message = (new MailMessage())
            ->greeting('您好 ' . $this->user->name . '！')
            ->line('您收到此封電子郵件是因為您已成功創建帳號於' . config('app.name') . '上。')
            ->line('使用者名稱：' . $this->user->username)
            ->line('E-Mail：' . $this->user->email);

        if (!is_null($this->token)) {
            return $message->action('設定您的帳號', url('/auth/password/reset/' . $this->token . '?email=' . urlencode($this->user->email)));
        }

        return $message;
    }
}
