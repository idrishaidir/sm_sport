<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Reservasi;

class StatusReservasiNotification extends Notification
{
    use Queueable;

    protected $reservasi;

    public function __construct(Reservasi $reservasi)
    {
        $this->reservasi = $reservasi;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $status = $this->reservasi->status;
        $namaPelanggan = $notifiable->name;
        $idTransaksi = $this->reservasi->id;
        $tanggalJadwal = \Carbon\Carbon::parse($this->reservasi->tanggal)->format('d M Y');
        $jamJadwal = $this->reservasi->jam_mulai;
        $lapangan = $this->reservasi->lapangan->nama_lapangan ?? 'Lapangan';

        $mailMessage = (new MailMessage)
            ->subject("Update Status Reservasi #{$idTransaksi} - SM Sport Center")
            ->greeting("Halo, {$namaPelanggan}!");

        if ($status == 'Lunas') {
            $mailMessage->line("Kabar baik! Pembayaran untuk reservasi Anda telah **DISETUJUI** oleh Admin.")
                ->line("Detail Jadwal Main Anda:")
                ->line("- **Lapangan:** {$lapangan}")
                ->line("- **Tanggal:** {$tanggalJadwal}")
                ->line("- **Jam:** {$jamJadwal} WIB")
                ->line("Silakan datang ke lokasi tepat waktu.");
        } else {
            $alasan = $this->reservasi->keterangan ?? 'Tidak ada keterangan tambahan.';
            $mailMessage->line("Mohon maaf, reservasi Anda dengan kode #{$idTransaksi} telah **DITOLAK** oleh Admin.")
                ->line("Alasan Penolakan: *\"{$alasan}\"*");
        }

        return $mailMessage->action('Buka Dashboard', url('/dashboard'))
            ->line('Terima kasih telah menggunakan layanan SM Sport Center!');
    }
}