<?php

include 'includes/WebPage.php';
class ListadoBajas extends WebPage {

    public function scripts() {
        parent::scripts();
    }

    public function content() {
        listadoEmpleadosBaja($this->db);
        echo "<h2>Empleados dados de baja</h2>";
        echo '<a href="pdf.php">Ver en pdf</a>';
        echo '&nbsp<a href="xml.php">Ver en xml</a><br/><br/>';
        echo $this->db->getHtmlTable($this->db->getLastResult(),"sortable","bdtable");

        
    }
    
    public function endScripts(){
        echo Util::addScript(JS.'sorter.js');
        echo Util::addScript(JS.'ordenacionListadoBajas.js');
    }
}

$page=new ListadoBajas();
?>