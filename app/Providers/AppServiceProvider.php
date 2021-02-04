<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ResetPassword::toMailUsing(function ($notifiable, $token) {
            return (new MailMessage)->view('admin.email.password-reset', ['token' => $token, 'email' => $notifiable->getEmailForPasswordReset()]);
            // ->subject('Situl nostru mesaj personalizat subject')
            // ->line('custom line')
            // ->action(Lang::get('Reset Password'), url(config('app.url') . route('password.reset', ['token' => $token, 'email' => $notifiable->getEmailForPasswordReset()], false)))
            // ->line('another line');
        });
    }
}
