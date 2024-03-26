<?php

namespace App\Notifications;

use App\Models\PricePercentChange;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class PricePercentChangeNotification extends Notification
{
    use Queueable;
    protected $priceChanges;
    /**
     * Create a new notification instance.
     */
    public function __construct($priceChanges)
    {
        $this->priceChanges = $priceChanges;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Notifikacija o promeni cena proizvoda')
            ->greeting('Ispod se nalaze zapažene promene cena za procenat koji ste odredili po kategorijama.')
            ->line(new HtmlString($this->generatePercentageChangesHtml()))
            ->salutation(' ');
    }

    public function generatePercentageChangesHtml()
    {
        $html = '';
        foreach ($this->priceChanges as $change) {
            $html .= '<div class="change-wrapper" style="width:100%;margin-bottom:10px;padding-bottom:10px;border-bottom:1px solid #000000">
                        <h3>' . $change->product->name . ' - ' . $change->product->company->name . '</h3>
                        <span>Stara cena: ' . $change->old_price . ' RSD</span><br>
                        <span>Nova cena: ' . $change->new_price . ' RSD</span><br>
                        <span>Zadati procenat promene: <b>' . $change->percentage_set . '% </b></span><br>
                        <span>Procenat promene cene: <b>' . $change->percentage_change . '% </b></span><br>
                        <span>Vreme zapažene promene: ' . $change->checked_at . '</span>
                      </div>';

            $change->notified = 1;
            $change->save();
        }
        return $html;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
