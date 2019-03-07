<?php

namespace App\Common;

class Dom
{
    public static function getContent($content,$feature,$tag)
    {


        $preg = "/<{$tag}[\s\w\"']?{$feature}[\s\w\"']?>([\s\S]+)<div class=\"page\">/";
        var_dump($preg);
        $res = preg_match_all($preg,$content,$match);

        echo $match[1][0];
    }


}