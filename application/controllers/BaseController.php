<?php

/**
 * Created by PhpStorm.
 * User: jim
 * Date: 2017/2/17
 * Time: 14:59
 */
class BaseController extends CI_Controller
{
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



}