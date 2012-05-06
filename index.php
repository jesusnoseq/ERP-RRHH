<?php
/*TODO
 * -Agregar tildes en sms y pdf con su utf8_decode
 * -filtro de moviles
 */

/**
 * Description of index
 * pagina principal, extiende de WebPage
 *
 * @author Jesus Rodriguez Perez
 */
 
include 'includes/WebPage.php';
class index extends WebPage {
    
    public function preload()
    {
        if($_GET['close']==1){
           session::set("id",0);
            session::destroy();
         }
    }

    public function scripts(){
        parent::scripts();
        echo Util::addScript(JS.'login.js');
    }

    public function content() {
        $user=$_POST['user'];
        $pass=$_POST['pass'];
        
        if($user && $pass){
            $id=$this->db->getScalar("select idlogin 
                                from login,empleado
                                where NIF like '$user' and password like '$pass'
                                and estado=0;",0,0);
            if($id==0){
                $failId=$this->db->getScalar("select idlogin 
                                              from login,empleado
                                              where NIF like '$user'");
                if($failId>0){
                    $errores=$this->db->getScalar("select errores from login
                                                   where idLogin=$failId");
                    $errores++;
                    $this->db->consulta("UPDATE login SET errores = $errores
                                        WHERE idLogin=$failId LIMIT 1;");
                }
            }
            session::set("id",$id);
        }else{
            //sesion cerrada
        }
        if((session::get("id"))==0)
            include TEMPLATES.'form_login.php';
        else{
             header('Location: listadoBajas.php');
            //echo '<a href="listadoBajas.php">Listado</a>';
            //echo '<a href="index.php?close=1">Cerrar sesion</a>';
        }

    }

    public function footer() {
        parent::footer();
        include TEMPLATES.'pie.php';
    }


}

$page=new index();
?>
