<?php
namespace app\index\controller;
use think\Controller;
use think\Db;


class Wed extends Controller
    {
        // 登录主页面
        public function index()
        {
            return $this->fetch();

        }

        // 登录方法
        public function indexs()
        {
        // 开启session
        session_start();

        //    echo "123456";
        $xm = input('post.zhhao');
        $mm = input('post.mima');
        $re = Db::table('student')
        ->where('student_name','=',$xm)
        ->where('pass_word','=',$mm)        
        ->select();

        if (empty($re)) {
            $this->error('登录失败');
        }else{
            if ($_SESSION == Null) {
                $_SESSION['id'] = $re['0']['id'];
                $_SESSION['name'] = $re['0']['student_name'];
            }else{
                unset($_SESSION);
                $_SESSION['id'] = $re['0']['id'];
                $_SESSION['name'] = $re['0']['student_name'];
            }

            $this->success('登录成功',"index/Wed/yemian");
        }
        }

        // 试卷列表选项页面
        public function yemian()
        {
            $data = Db::table('test')
            ->where('status','=','1')
            ->select();
            
            $this->assign("data",$data);
            return $this->fetch();

        }

        // 试卷提交判断考试时间方法
        public function ym_t(){
            session_start();
            $post = input('post.ti');
            $data = Db::table('test')
            ->where('test_name','=',$post)
            ->select();
            // dump($data);
            $k = strtotime($data['0']['create_time']);
            $time = time();
            $j = strtotime($data['0']['end_time']);
            $a = $data['0']['id'];
            if ($k < $time && $time < $j) {
                
                if (count($_SESSION) == 3 || count($_SESSION) == 4) {
                    $_SESSION['test_id'] = $a;
                    $_SESSION['test_name'] = $data['0']['test_name'];
                }else{
                    unset($_SESSION['test_id']);
                    unset($_SESSION['test_name']);
                    $_SESSION['test_id'] = $a;
                    $_SESSION['test_name'] = $data['0']['test_name'];
                }
                $this->error('开始考试',"http://tp5-1demo.com/index.php/index/wed/ti?id=$a");
            }else{
                $this->success('抱歉，您不在考试时间内');
            }
        }

        // 考试页面
        public function ti(){
            $id = input('get.id');
            $data = Db::table('test_info')
            ->where('test_id','=',$id)
            ->select();

            $this->assign("id",$id);
            $this->assign("data",$data);
            return $this->fetch();

        }

        // 分数页面
        public function fen(){
            session_start();
            // 取出每题分数值
            $get = input('get.id');
            $fen = Db::table('test')
            ->where('id','=',$get)
            ->select();
            $zhi = $fen['0']['score'];
            
            // 计算正确答案数量
            $post = input('post.');
            $data = Db::table('test_info')
            ->where('test_id','=',$get)
            ->select();
            // var_dump($post);
            // var_dump($data);
            $fenshu = 0;
            

            $student_id = $_SESSION['id'];
            $name = $_SESSION['name'];
            $test_id = $_SESSION['test_id'];
            $test_name = $_SESSION['test_name'];

            foreach ($post as $key => $value) {
                $is_real = 0;
                foreach ($data as $k => $v) {
                    // echo $k . '<br>' . $v['sort'] . '<hr>';
                    if ($key == $v['sort'] && $value == $v['option_real']) {
                        $is_real = 1;
                        $fenshu += $zhi;
                    }
                }

                $data_s = [
                            'student_id' => $student_id,
                            'test_id' => $test_id,
                            'sort_id' => $key,
                            'result' => $value,
                            'is_real' => $is_real,
                            ];
                        $re = Db::table('grade_info')
                        ->insert($data_s);

            }

            // 向数据库提交考试数据
            $datax = [
                'student_id' => $student_id,
                'student_name' => $name,
                'test_id' => $test_id,
                'test_name' => $test_name,
                'grade' => $fenshu,
                ];
            $re = Db::table('grade')
            ->insert($datax);

            // $this->assign("data",$fenshu);
            // return $this->fetch();
            if ($fenshu  != 0 || $fenshu  == 0) {
                $this->error('提交成功');
            }else{
                $this->success('提交失败');
            }
            
        }
}

?>