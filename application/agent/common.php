<?php
/**
 * Created by PhpStorm.
 * User: zzlin
 * Date: 2016/9/18
 * Time: 11:44
 */

if(!function_exists('rights'))
{
    function rights($str,$id,$name,$menuid=0){
        $str = str_replace('@id@',$id,$str);
        $str = str_replace('@menuid@',$menuid,$str);
        $str = str_replace('@name@',$name,$str);
        return $str;
    }
}


