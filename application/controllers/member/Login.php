<?php

require_once 'Base.php';

/**
 * Created by PhpStorm.
 * User: jim
 * Date: 2017/2/17
 * Time: 9:43
 */
class Login extends Base
{
    /**
     *check if the user is logged, and redirect
     */
    public function index()
    {
        $this->load->library('session');

        //check if the user is logged
        if (!User::IsAuthenticated()) {
            $this->load->view('member/login');
            //            if (uri_string() == "portal/get_video_url")
//                return;
//            if (uri_string() == 'portal/refreshData' &&
//                $this->isOauthPass()
//            ) {
//                return;
//            }
        } else {
            redirect('/');
        }

    }

    /**
     * @return bool
     */
    public function isOauthPass()
    {
        $request = new League\OAuth2\Server\Util\Request();
        //包含"application/config/database.php"
        require_once "application/config/database.php";
        $conn_str = 'mysql://' . $db['default']['username'] . ":" . $db['default']['password'] .
            '@' . $db['default']['hostname'] . '/' .$db['default']['database'];
        $db = new League\OAuth2\Server\Storage\PDO\Db($conn_str);

        $this->server = new League\OAuth2\Server\Resource(new League\OAuth2\Server\Storage\PDO\Session($db));
        //可能抛出异常
        try {
            $this->server->isValid();
            $this->user = User::GetUserById($this->server->getOwnerId());
            return true;
        } //处理异常
        catch (League\OAuth2\Server\Exception\InvalidAccessTokenException $e) {
            return false;
        }
    }

    /**
     * user logged in and redirect
     */
    public function loginCheck()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('txtUsername', '用户名', 'trim|required');
            $this->form_validation->set_rules('txtPasswd', "密码", 'required');
            if ($this->form_validation->run()) {
                $username = $this->input->post('txtUsername');
                $password = $this->input->post('txtPasswd');
                $val = User::ValidUser($username, $password, false);
                if ($val == 1) {
                    $isRemember = $this->input->post("cbIsRemember");
                    if ($isRemember != "true") {
                        $isRemember = false;
                    } else {
                        $isRemember = true;
                    }
                    if (User::LogInUser($username, $password, false, $isRemember)) {
                        if ($_SESSION['XJTELEDH_USERROLE'] != 'door_user') {
                            redirect("/portal");
                        } else {
                            session_destroy();
                            $data['msg'] = "门禁用户无法登录网站!";
                        }
                    } else {
                        $data['msg'] = "登录失败，请重试!";
                    }
                } else {
                    $data['msg'] = "您的用户名密码不匹配!";
                }
            } else {
                $data['msg'] = "请填写用户名和密码";
            }
        }
        $this->load->view('member/login');
    }

    /**
     * logout and redirect to mainpage
     */
    public function logout()
    {
        session_destroy();
        redirect('/');
    }


}