<?php
namespace app\index\controller;
use think\Controller;
use util\ExcelTool;
use think\Db;


class Dome extends Controller
{
    // 主页面--显示试卷列表
    public function index(){
        $data = Db::table('test')
        ->where('status','=','1')
        ->select();
        // dump($data);
        $this->assign("name",$data);
        return $this->fetch();

    }

    // 添加试卷页面
    public function index_index(){
        return $this->fetch();
    }

    // 添加试卷方法
    public function index_index_t(){
        $postx = input('post.');
        $insex = [
            'test_name' => $postx['name'],
            'create_time' => $postx['k_k'],
            'end_time' => $postx['k_j'],
            'status' => $postx['zht'],
            'test_num' => $postx['shul'],
            'score' => $postx['fen'],
            ];
        $re = Db::table('test')
        ->insert($insex);

        if (empty($re)) {
            $this->error('添加失败');
        }else{
            $this->success('添加成功',"index/Dome/index");
        }

    }

    // 删除试卷方法
    public function index_del(){
        $getx = input('get.');
        $a = $getx['id'];

        $re = Db::table('test')
        ->where('id','=',$a)
        ->delete();

        if (empty($re)) {
            $this->error('删除失败');
        }else{
            $this->success('删除成功');
        }
        
    }

    // 修改试卷信息页面
    public function index_x_index(){
        $getx = input('get.');
        $id = $getx['id'];

        $data = Db::table('test')
        ->where('id','=',$id)
        ->select();

        $this->assign("id",$id);
        $this->assign("data",$data);
        return $this->fetch();

    }

    // 修改试卷方法
    public function index_x(){
        $postx = input('post.');
        $id = input('get.id');
        // $id = $this->index_x_index(); 
        $re = Db::table('test')
        ->where('id',$id)
        ->update([
            'test_name' => $postx['name'],
            'create_time' => $postx['k_k'],
            'end_time' => $postx['k_j'],
            'status' => $postx['zht'],
            'test_num' => $postx['shul'],
            'score' => $postx['fen'],
            ]);
        
        if (empty($re)) {
            $this->error('修改失败');
        }else{
            $this->success('修改成功',"index/Dome/index");
        }
    }


    // 输出学生列表
    public function name(){
        $data = Db::table('student')
        // ->order('id','DESC')
        ->select();
        // dump($data);
        $this->assign("name",$data);
        return $this->fetch();
    }

    // 添加考生信息页面
    public function name_index(){
        
        return $this->fetch();

    }

    // 添加考生方法
    public function name_index_t(){
        $postx = input('post.');
        $insex = [
            'student_name' => $postx['name'],
            'xhao' => $postx['xhao'],
            'pass_word' => $postx['mima'],
            ];
        $re = Db::table('student')
        ->insert($insex);

        if (empty($re)) {
            $this->error('添加失败');
        }else{
            $this->success('添加成功',"index/Dome/name");
        }
    }

    // 删除学生信息方法
    public function name_del(){
        $getx = input('get.');
        $a = $getx['id'];

        $re = Db::table('student')
        ->where('id','=',$a)
        ->delete();

        if (empty($re)) {
            $this->error('删除失败');
        }else{
            $this->success('删除成功');
        }
        
    }

    // 修改学生信息页面
    public function name_x_index(){
        $getx = input('get.');
        $id = $getx['id'];

        $data = Db::table('student')
        ->where('id','=',$id)
        ->select();

        $this->assign("id",$id);
        $this->assign("data",$data);
        return $this->fetch();

    }

    // 修改学生信息方法
    public function name_x(){
        $postx = input('post.');
        $id = input('get.id');
        $re = Db::table('student')
        ->where('id',$id)
        ->update([
            'student_name' => $postx['name'],
            'xhao' => $postx['xhao'],
            'pass_word' => $postx['mima'],
            ]);
        
        if (empty($re)) {
            $this->error('修改失败');
        }else{
            $this->success('修改成功',"index/Dome/name");
        }
    }

    // 输出所有单选题
    public function topic(){
        $data = Db::table('test_info')
        // ->order('id','DESC')
        ->select();
        // dump($data);
        $this->assign("topic",$data);
        return $this->fetch();
    }

    // 添加单选题页面
    public function topic_index(){
        return $this->fetch();
    }

    // 添加单选题·方法
    public function topic_index_t(){
        $postx = input('post.');
        $insex = [
            'test_id' => $postx['i_id'],
            'sort' => $postx['tihao'],
            'test_content' => $postx['text'],
            'option_a' => $postx['text_a'],
            'option_b' => $postx['text_b'],
            'option_c' => $postx['text_c'],
            'option_d' => $postx['text_d'],
            'option_real' => $postx['text_zh'],
            ];
        $re = Db::table('test_info')
        ->insert($insex);

        if (empty($re)) {
            $this->error('添加失败');
        }else{
            $this->success('添加成功',"index/Dome/topic");
        }
    }

    // 删除单选题方法
    public function topic_del(){
        $getx = input('get.');
        $a = $getx['id'];

        $re = Db::table('test_info')
        ->where('id','=',$a)
        ->delete();

        if (empty($re)) {
            $this->error('删除失败');
        }else{
            $this->success('删除成功');
        }
    }

    // 修改学生信息页面
    public function topic_x_index(){
        $getx = input('get.');
        $id = $getx['id'];
    
        $data = Db::table('test_info')
        ->where('id','=',$id)
        ->select();
    
        $this->assign("id",$id);
        $this->assign("data",$data);
        return $this->fetch();
    
    }
    
    // 修改学生信息方法
    public function topic_x(){
        $postx = input('post.');
        $id = input('get.id');
        $re = Db::table('test_info')
        ->where('id',$id)
        ->update([
            'test_id' => $postx['i_id'],
            'sort' => $postx['tihao'],
            'test_content' => $postx['text'],
            'option_a' => $postx['text_a'],
            'option_b' => $postx['text_b'],
            'option_c' => $postx['text_c'],
            'option_d' => $postx['text_d'],
            'option_real' => $postx['text_zh'],
            ]);
            
        if (empty($re)) {
            $this->error('修改失败');
        }else{
            $this->success('修改成功',"index/Dome/topic");
        }
    }

    // 成绩单页面
    public function chj(){
        $data = Db::table('grade')
        ->select();
        $this->assign("data",$data);
        return $this->fetch();
    }

    // 成绩详情表
    public function chj_index(){
        $get = input('get.id');
        $data = Db::table('grade_info')
        ->where('student_id',$get)
        ->select();

        $this->assign("data",$data);
        return $this->fetch();
    }

    //成绩单表格生成
    public function exl(){
        $get = input('get.id');
        if ($get == 1) {
            $excel = new ExcelTool();
            $th = ['ID','学生id','学生名','考试id','考试分数','成绩分数'];

            $data = Db::table('grade')
            // ->field('pid,name,age,xb')
            ->select();
            // dump($data);
            $excel->dumpExcel('成绩单','成绩',$th,$data); 
        }
        
    }

}