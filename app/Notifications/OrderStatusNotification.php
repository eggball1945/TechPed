<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OrderStatusNotification extends Notification
{
    use Queueable;

    protected $order;
    protected $status;
    protected $message;

    public function __construct(Order $order, $status, $message = null)
    {
        $this->order = $order;
        $this->status = $status;
        $this->message = $message ?? $this->getDefaultMessage($status);
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'status'   => $this->status,
            'title'    => $this->getTitle(),
            'message'  => $this->message,
            'products' => $this->getProductNames(),
        ];
    }

    private function getTitle()
    {
        $titles = [
            'checkout'   => 'Pesanan Dibuat',
            'diproses'   => 'Pesanan Diproses',
            'dikirim'    => 'Pesanan Dikirim',
            'selesai'    => 'Pesanan Selesai',
            'dibatalkan' => 'Pesanan Dibatalkan',
        ];
        return $titles[$this->status] ?? 'Notifikasi Pesanan';
    }

    private function getProductNames()
    {
        $products = $this->order->products; // collection of products
        if ($products->isEmpty()) {
            return 'produk';
        }

        $names = $products->pluck('nama_produk')->toArray();
        $first = $names[0];

        if (count($names) === 1) {
            return $first;
        }

        $remaining = count($names) - 1;
        return "{$first} dan {$remaining} produk lainnya";
    }

    private function getDefaultMessage($status)
    {
        $productNames = $this->getProductNames();

        $messages = [
            'checkout'   => "Pesanan dengan produk {$productNames} berhasil dibuat.",
            'diproses'   => "Pesanan dengan produk {$productNames} sedang diproses.",
            'dikirim'    => "Pesanan dengan produk {$productNames} sedang dalam pengiriman. Mohon konfirmasi penerimaan jika sudah sampai.",
            'selesai'    => "Pesanan dengan produk {$productNames} telah selesai. Terima kasih telah berbelanja!",
            'dibatalkan' => "Pesanan dengan produk {$productNames} telah dibatalkan.",
        ];
        return $messages[$status] ?? "Status pesanan dengan produk {$productNames} berubah.";
    }
}