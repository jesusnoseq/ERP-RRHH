
<div id="menu">
    <?php
        $actual=Util::getActualPage(0);
        $id=session::get('id');
        
        $menu=array(
            array("listadoBajas.php","Empleados dados de baja",1),
            array("index.php?close=1","Salir",1)
        );

        foreach ($menu as $enlace) {
            if($actual==$enlace[0] && $id>=$enlace[2]){
               echo '<a class="topMenu current" href="'.$enlace[0].'">'.$enlace[1].'</a>';
            }else if($id>=$enlace[2]){
               echo '<a class="topMenu"  href="'.$enlace[0].'">'.$enlace[1].'</a>';
            }
        }
        
    ?>
</div>
