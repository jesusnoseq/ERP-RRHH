<?php
$actual=Util::getActualPage();
$id=session::get('id');

if($actual!='index.php'){

    if( $id<1 ) {
        header('Location: index.php?error=necesitas estar registrado ');
    }
}


?>
