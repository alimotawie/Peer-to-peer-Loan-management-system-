<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;


class RateAndReview extends Notification
{
    use Queueable;
    private $review;
    Private $rate;
    private $from;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($rate , $review,$from)
    {
        //
        $this->review = $review;
        $this->rate = $rate;
        $this->from =$from;
    }

    public function via ($notifiable)
    {

        return ['database'];
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

            'rate' => $this->rate,
        'review' => $this->review,
            'from'=>$this->from

            //
        ];
    }


}
