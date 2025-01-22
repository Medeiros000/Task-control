<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;

    public $email;

    public $name;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, $email, $name)
    {
        $this->token = $token;
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = 'http://localhost:8000/password/reset/' . $this->token . '?email=' . $this->email;
        $minutes = config('auth.passwords.' . config('auth.defaults.passwords') . '.expire');
        $greeting = 'Hello! ' . $this->name;
        return (new MailMessage)
            ->subject('Reset Password Notification')
            ->greeting($greeting)
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action(('Reset Password'), $url)
            ->line('This password reset link will expire in ' . $minutes . ' minutes.')
            ->line('If you did not request a password reset, no further action is required.')
            ->salutation('See you soon!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
