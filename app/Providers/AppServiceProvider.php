<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Verifikasi Akun SM Sport Center Anda') 
                ->greeting('Halo, ' . $notifiable->name . '!') 
                ->line('Terima kasih telah melakukan registrasi di aplikasi SM Sport Center.') 
                ->line('Langkah terakhir sebelum Anda dapat melakukan booking lapangan, silakan klik tombol di bawah ini untuk mengaktifkan akun Anda.') // <-- Baris Kalimat 2
                ->action('Verifikasi Email Saya', $url) 
                ->line('Tautan verifikasi ini hanya berlaku sementara. Jika Anda tidak merasa mendaftar, silakan abaikan email ini.') // <-- Baris Kalimat 3
                ->salutation("Salam Olahraga,\nTim SM Sport Center");
        });
    }
}
