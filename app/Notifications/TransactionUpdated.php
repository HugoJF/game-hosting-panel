<?php

namespace App\Notifications;

use App\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TransactionUpdated extends Notification
{
    use Queueable;

    protected Transaction $transaction;
    protected int $from;
    protected int $to;

    /**
     * Create a new notification instance.
     *
     * @param Transaction $transaction
     * @param int         $from
     * @param int         $to
     */
    public function __construct(Transaction $transaction, int $from, int $to)
    {
        $this->transaction = $transaction;
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Transaction updated')
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable): array
    {
        return [
            'title'          => 'Transaction value updated',
            'transaction_id' => $this->transaction->id,
            'from'           => $this->from,
            'to'             => $this->to,
        ];
    }
}
