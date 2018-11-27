<?php

namespace Core;


class SessionHandler
{

    private $sessionId;

    public function __construct()
    {
        if (!isset($_SESSION)) {
            $this->start();
            $this->setSessionId();
        }
    }

    public function start()
    {
        session_start();
    }

    public function setToken()
    {
        $token = bin2hex(random_bytes( 32 ));
        $this->set('token', $token);
    }

    public function setSessionId() {

        $this->sessionId = session_id();
    }

    public function getSessionId()
    {
        return $this->sessionId;
    }

    public function parameterExist($session)
    {
        return isset($_SESSION[$session]);
    }

    public function setParameter($session, $is_array = false)
    {

        if( !isset($_SESSION[$session])  ){
            if($is_array){
                $_SESSION[$session] = array();
            }
            else{
                $_SESSION[$session] = '';
            }
        }
    }

    public function removeSession( $session_name = '' ){
        if( !empty($session_name) ){
            unset( $_SESSION[$session_name] );
        }
        else{
            unset($_SESSION);
        }
    }

    public function destroySession()
    {
        session_destroy();
    }

    public function get($session_name){
        if (isset($_SESSION[$session_name])){
            return $_SESSION[$session_name];
        } else return null;
    }

    public function set( $sessionName , $data ){
        $_SESSION[$sessionName] = $data;
    }



    //TODO: move to class
    public function isAdmin() {

        if (isset($_SESSION["users_group"])){

            $userGroup = intval($_SESSION["users_group"]);
            $isAdmin = false;

            if ($userGroup == 2){
                $isAdmin = true;
            }
        }

        return $isAdmin;
    }
}
