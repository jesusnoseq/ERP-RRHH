<?php

/**
 * Description of WebPage(26-02-2010)
 * clase abstracta para que las paginas las implementen y olvidarme de
 * las cosas comunes que se hacen en todas las paginas, igualmente
 * si cambia la estrutura general basta con cambiar el el "template"
 * (la plantilla) para cambiar por completo la estructura de la pagina.
 *
 * @author Enano007jr
 * @version 0.46 (06/05/2012)
 * @example
        <?php
        include 'includes/WebPage.php';
        class index extends WebPage{
            public function content(){
                echo "hola mundo";
            }
        }
        $page=new index();
        $page->show();
        ?>
 */
 
define('DEBUG',false);
define('TITLE','ERP RRHH');

define('INCLUDES','includes/');
define('LIBS','libraries/');
define('TEMPLATES','templates/');
define('JS','js/');
define('CSS','css/');

abstract class WebPage{
    var $autoload=array(
            'session.php',
            'Util.php',
            'MDB.php',
            'controlAcceso.php',
            'listados.php'
        );

    var $title;
    var $db;

    public function __construct($title=TITLE) {
        $this->title=$title;

        $this->includes();
        $this->instances();

        $this->show();
    }

    public function getTitle(){
        return $this->title;
    }

    public function includes(){
        foreach ($this->autoload as $file) {
            include (INCLUDES.$file);
        }
    }

    public function instances(){
        $this->db=new MDB();
    }
    public function preload(){}

    public function scripts(){
        echo Util::addScript(JS.'jquery-1.6.2.min.js');
        echo Util::addScript(JS.'jquery-ui-1.8.14.custom.min.js');
        echo Util::addScript(JS.'jsGeneric.js');
    }

    public function menu() {
        include TEMPLATES.'cabecera.php';
        include TEMPLATES.'menu.php';
    }

    public abstract function content();
    
    public function footer() {
        if($_GET['error']){
            echo '<div class="error ocultable">[ERROR]<BR>'.$_GET['error'].'</div>';
        }
        //include TEMPLATES.'pie.php';
    }

    public function endScripts(){
        if(DEBUG)
            globalVarsView();
    }

    public function end(){
        $this->db->close();
    }

    public function show($template="baseTemplate.php") {
        include (TEMPLATES.$template);
    }
}
?>
