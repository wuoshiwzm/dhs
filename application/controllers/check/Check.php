<?php
/**
 * Created by PhpStorm.
 * User: jim
 * Date: 2017/2/21
 * Time: 10:53
 */


/**
 * Class CheckController
 * 审核模块页面控制器
 */
class Check extends CI_Controller
{

    private $userObj;

    public function __construct()
    {
        parent::__construct();
        if (!User::IsAuthenticated()) {
            redirect('/member/login');
        } else {
            $this->userObj = User::GetCurrentUser();
            User::Set_UserWebOnline($this->userObj->id);
        }
    }

    //审核画面
    public function index()
    {
        //public function allowRole($type, $roleAllow = null, $roleApply = null)
        //check_role:1:一级审核 2:二级审核 3:查看，只能看，不能操作

        $check_role = $this->userObj->check_role;

        //导向一级审查页面
        if (Author::allowRole(4, 1, $check_role)) {
            $this->firstCheck();
        }

        //导向二级审查页面
        if (Author::allowRole(4, 2, 2)) {
            //die('second check');
        }
//        die('welecome to checking--');

    }

    private function firstCheck()
    {
        $data = array();
        $data['userObj'] = $this->userObj;
        $data['bcList'] = array();
        $bcObj = new Breadcrumb();
        $bcObj->title = '审核工程 - 一级审核';
        $bcObj->url = site_url("check/check");
        $bcObj->isLast = true;
        array_push($data['bcList'], $bcObj);



        $dbObj = $this->load->database('default', TRUE);
        var_dump($dbObj->get('check_apply'));
        die;

        $dbObj->whereNot('check_jim', 1);
        $dbObj->select('*');
        $row = $dbObj->get('check_apply')->result();

        var_dump($row);die;


        $content = $this->load->view("check/first_check", $data, TRUE);
        $this->mp_master->Show_Portal($content, NULL, '一级审核', $data);
    }


    private function secondCheck()
    {

    }

    private function approve()
    {

    }


}