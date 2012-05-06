<?php
/**
 * Description of session
 *
 * @author Enano007jr
 */
class session {

    function __construct() {
        $this->start();
    }

    function start() {
        if( !isset($_SESSION['ss'])){
            session_cache_limiter('none');
            session_start();
                        $_SESSION['ss']=1;
        }else{
            //session_regenerate_id();
        }
       
        //$this->validate();
        return true;
    }

    function destroy() {
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time()-42000, '/');
        }

        session_unset();
        session_destroy();

        return true;
    }

    function set($nombre,$valor=false) {
        //session_register($nombre,$valor);
        $_SESSION[$nombre]=$valor;
    }

    function get($nombre) {        
        if (isset ($_SESSION[$nombre]) ) {
            return $_SESSION[$nombre];
        } else {
            return false;
        }
    }

    function exist($nombre){
        return isset ($_SESSION[$nombre]) ;
    }
}

session::start();
?>
