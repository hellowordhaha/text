<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function get_Salt($as){
    $str1 = 'abcdefghijknmlopqrstuvwxyz';
    $str2 = 'ABCDEFGHIGKNMLOPQRSTUVWXYZ';
    $str3 = '0123456789';
    $str = $str1 . $str2 . $str3 ;
            
    $s = '';
            
    // 取出固定长度
    for ($i=0; $i < $as ; $i++) { 
        $index = mt_rand(1,strlen($str));
        $s .= $str[$index];
    }
    return $s;
}
            
