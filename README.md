# 中文验证码
![Geetest Image Demo](http://aixue.img-cn-hangzhou.aliyuncs.com/20161102103454_97263.png)

## Installation

Laravel 5.0.0 or later is required.

To get the latest version of Laravel Markdown, simply require the project using Composer:

```
$ composer require kangkang66/captcha
```

Next, You should need to register the service provider. Open up `config/app.php` and add following into the `providers` key.

```php
\Chinesecaptcha\ChinesecaptchaServiceProvider::class
```

How to use it

```php
//引用验证码
public function Captcha(Chinesecaptcha $chinesecaptcha)
{
    $chinesecaptcha->outPut();
}

//验证
public function Valid(Request $request)
{
     //1.使用验证规则
     $validParams = [
            'captcha'   => 'required|chinesecaptcha',
     ];
     //2.直接使用 session
     $str = session()->get('captcha');
}

```

