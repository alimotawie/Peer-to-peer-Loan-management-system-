<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CashRequest extends Notification
{
    use Queueable;
    Protected $amount ;
    Protected $from;
    Protected $loanID;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($amount ,$from,$loanID)
    {
        //
        $this->amount=$amount;
        $this->from=$from;
        $this->loanID=$loanID;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    public function toArray($notifiable)
    {
        return [
            //


            'loanID' => $this->loanID,
            'amount' => $this->amount,
            'from' => $this->from


        ];
    }
}
