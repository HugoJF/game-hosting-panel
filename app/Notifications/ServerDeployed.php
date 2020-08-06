<?php

namespace App\Notifications;

use App\Server;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ServerDeployed extends Notification
{
    use Queueable;
    /**
     * @var Server
     */
    protected Server $server;

    /**
     * Create a new notification instance.
     *
     * @param Server $server
     */
    public function __construct(Server $server)
    {
        $this->server = $server;
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
            ->subject('Server deployed')
            ->line("Server $this->id was deployed!")
            ->action('View server', route('servers.show', $this->server))
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
            'title'     => "Server {$this->server->name} was deployed!",
            'server_id' => $this->server->id,
        ];
    }
}
