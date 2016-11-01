<?php
namespace Chinesecaptcha;
use Illuminate\Support\ServiceProvider;

class ChinesecaptchaServiceProvider extends ServiceProvider
{

    public function boot(Request $request)
    {
        Validator::extend('chinesecaptcha', function () use ($request)
        {
            list($captcha) = array_values($request->only('captcha'));
            if($captcha == session()->get('captcha'))
            {
                return true;
            }
            return false;
        });
    }


    public function register()
    {
        $this->app->singleton('chinesecaptcha', function () {
            return $this->app->make('Chinesecaptcha\ChinesecaptchaLib');
        });
    }
}


