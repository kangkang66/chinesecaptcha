<?php
namespace Chinesecaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Validator;

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
            return $this->app->make('Chinesecaptcha\Chinesecaptcha');
        });
    }
}


