<?php
/**
 * Created by PhpStorm.
 * User: jim
 * Date: 2017/2/17
 * Time: 14:59
 */


class BaseController extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        if (!User::IsAuthenticated()) {
            if (uri_string() == "portal/get_video_url")
                return;
            if (uri_string() == 'portal/refreshData' && $this->isOauthPass()) {
                return;
            }
            redirect('/member/login');
        } else {

            $this->userObj = User::GetCurrentUser();
            User::Set_UserWebOnline($this->userObj->id);
        }
    }

    /**
     * @param $type 过滤权限的类型
     * 1: role 如'admin','noc';
     * 2: city
     * 3: role & city
     * @param null $roleName
     * 对应type的权限允许范围 可以是数组或字符串
     * @return bool
     * 权限过滤
     */
    protected function allowRole($type,$roleName = null)
    {
        //1: role
        if($type == 'role'){
            $role = $_SESSION['XJTELEDH_USERROLE'];
            if(is_null($roleName)){
                return true;
            }
            if(is_array($roleName)){
                if(in_array($role,$roleName)){
                    return true;
                }
                die('权限不足！');
            }else{
                if($role == $roleName){
                    return true;
                }
            }
            die('权限不足！');
        }

        //2: city
        if($type == 2){

        }

        //3:role + city
        if($type == 3){

        }
        die('权限不足！');
    }

}