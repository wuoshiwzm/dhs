<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: jim
 * Date: 2017/2/17
 * Time: 9:50
 */
class Base extends CI_Controller {
    public function __construct()
    {
//        die('base');
        parent::__construct();
//        if (!User::IsAuthenticated()) {
//            if (uri_string() == "portal/get_video_url")
//                return;
//            if (uri_string() == 'portal/refreshData' && $this->isOauthPass()) {
//                return;
//            }
//            redirect('/member/login');
//        } else {
//            $this->userObj = User::GetCurrentUser();
//            User::Set_UserWebOnline($this->userObj->id);
//        }
    }

    public function index()
    {

    }


}

