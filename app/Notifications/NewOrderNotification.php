<?php

namespace App\Notifications;

use App\Models\Order;
use Filament\Notifications\Actions\Action as FilamentAction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Filament\Notifications\Notification as FilamentNotification;

class NewOrderNotification extends Notification
{
    use Queueable;

    protected $order;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toDatabase(object $notifiable): array
    {
        return FilamentNotification::make()
            ->title('Pesanan Baru Diterima!')
            ->body("Anda menerima pesanan baru #{$this->order->order_number} dari {$this->order->buyer->name}.")
            ->icon('heroicon-o-shopping-cart')
            ->actions([
                FilamentAction::make('view')
                    ->label('Lihat Pesanan')
                    ->url(route('filament.supplier.resources.orders.view', $this->order), shouldOpenInNewTab: true)
                    ->markAsRead(),
            ])
            ->getDatabaseMessage();
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'order_number' => $this->order->order_number,
            'buyer_name' => $this->order->buyer->name,
            'message' => "Anda menerima pesanan baru #{$this->order->order_number} dari {$this->order->buyer->name}.",
            'url' => route('filament.supplier.resources.orders.view', $this->order),
        ];
    }
}
