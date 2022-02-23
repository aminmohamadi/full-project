<?php

namespace App\Notifications;

use App\Notifications\SmsChannels\RayganSmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SmsActivationCodeNotification extends Notification
{
    use Queueable;
    public $code;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [RayganSmsChannel::class];
    }
    public function toSms(){
        return [
          "two_factor_message" => "کد ورود شما {$this->code} می باشد."."\n".env('APP_TITLE'),
        ];
    }
}
