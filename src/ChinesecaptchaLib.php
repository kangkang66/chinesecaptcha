<?php
namespace Chinesecaptcha;

class ChinesecaptchaLib
{
    private $text;

    public function build()
    {
        $this->text = "韩康康";
    }

    //获取文本
    public function getText()
    {
        return $this->text;
    }

    public function outPut()
    {
        session()->put('captcha', $this->text);
    }


}

