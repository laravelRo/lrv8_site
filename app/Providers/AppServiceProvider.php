<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;


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

        $menu_categories = Category::select('title', 'slug')->orderBy('title')->where('publish', 1)->get();
        View::share('menu_categories', $menu_categories);

        Paginator::useBootstrap();
    }
}
