<?php
namespace Chinesecaptcha;

class ChinesecaptchaLib
{
    private $text;
    private $width=120;
    private $height=45;
    private $font_num=4;
    private $font_size=20;

    public function build($width=150, $height=100)
    {
        $this->width = $width;
        $this->height = $height;
    }

    private function createText($font_num)
    {
        $word = file_get_contents("chinese");
        $list = explode(" ",$word);
        $count = count($list)-1;
        $text = [];
        for ($i=0;$i<$font_num;$i++)
        {
            $text[] = $list[rand(0,$count)];
        }
        session()->put('captcha', implode('',$text));
        return $text;
    }


    public function outPut()
    {
        $this->text = $this->createText($this->font_num);

        header("content-type: image/png");
        $image=imagecreate($this->width, $this->height);
        imagecolorallocate($image,0xff,0xff,0xff);                //设定背景颜色
        $rectangle_color=imagecolorallocate($image,0xAA,0xAA,0xAA); //边框颜色
        $noise_color=imagecolorallocate($image,0x00,0x00,0x00);     //杂点颜色
        $font_color=imagecolorallocate($image,0x00,0x00,0x00);      //字体颜色
        $line_color=imagecolorallocate($image,0x33,0x33,0x33);      //干扰线颜色

        //加入杂点
        for($i=0;$i<80;$i++){
            imagesetpixel($image,mt_rand(0, $this->width),mt_rand(0, $this->height), $noise_color);
        }

        $font_face = "../font/simsun.ttf";
        $x = 2;
        foreach ($this->text as $code)
        {
            imagettftext($image, $this->font_size, mt_rand(-6,6), $x, 30,$font_color, $font_face, $code);
            $x+=30;
        }

        //加入干扰线
        for($i=0;$i<$this->font_num-2;$i++){
            imageline($image,mt_rand(0, $this->width),mt_rand(0, $this->height),
                mt_rand(0,$this->width),mt_rand(0,$this->height),$line_color);
        }

        imagerectangle($image,0,0,$this->width-1,$this->height-1,$rectangle_color);  //加个边框
        imagepng($image);
        imagedestroy($image);
    }

    //获取文本
    public function getText()
    {
        return implode('',$this->text);
    }
}

