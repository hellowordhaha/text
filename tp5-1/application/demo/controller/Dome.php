<?php
namespace app\demo\controller;
use think\Controller;

vendor('aip-php-sdk-4.15.1/AipImageProcess.php');
const APP_ID = '24043605';
const API_KEY = 'eI4Pe0lbn8sayrUCYR0SbTGp';  
const SECRET_KEY = 'EqaI5KkbxKymBHLceLrn9dbrdGSGVvFV';

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

         $client = new AipImageProcess(APP_ID, API_KEY, SECRET_KEY);
         $options = array("type"=>"anime", "mask_id"=>3)
         $image = file_get_contents('../uploads/20210422/1.jpg');
          $client->selfieAnime($image, $options);
         var_dump($client);
 }


}