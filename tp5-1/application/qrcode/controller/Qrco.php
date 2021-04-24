<?php

namespace app\qrcode\controller;
use think\Controller;
use util\QRcode;


Class Qrco extends Controller
{
  public function demo(){
  $text = "光的力量，盖亚！！！";

  $dome = new QRcode();

  // 是否生成图片
  $outfile = false;
  // $outfile = '12-14dang.png';

  // 这个参数控制二维码容错率 L级别 
  $level = 'QR_ECLEVEL_L'; // QR 二维码的缩写

  // 控制生成图片的大小，默认为4；
  $size = 15;

  // 控制生成二维码的空白区域大小；白边边距大小
  $margin = 2;

  // 保存二维码图片并显示出来，图片保存位置
  $saveandprint = false;
  // $saveandprint = __DIR__;
  
  //清楚缓存 
  ob_end_clean();
  
  $dome::png($text,$outfile,$level,$size,$margin,$saveandprint);

  // 结束符
  exit();
  
  }
}


?>