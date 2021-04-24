<?php
namespace app\demo\controller;
use think\Controller;


class Dome extends Controller
{
    public function index(){
         echo 11111;
         var_dump($_FILES);
        $file = request()->file('file');
        $info = $file->move( '../uploads');
        if($info){
            echo $info->getSaveName();
           
        }else{
            echo $file->getError();
            die();
        }

//          $client = new AipImageProcess(APP_ID, API_KEY, SECRET_KEY);
//          $options = array("type"=>"anime", "mask_id"=>3)
//          $image = file_get_contents('../uploads/20210422/1.jpg');
//           $client->selfieAnime($image, $options);
//          var_dump($client);
 }


}
