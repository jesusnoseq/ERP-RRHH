<?php $this->preload(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 4.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es" dir="ltr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name='robots' content='none' />
        <meta name='author' content='Jesus Rodriguez Perez' />
        <meta name='description' content='ERP de RRHH' />

        <title><?php echo $this->getTitle(); ?></title>

        <link href="css/estilo.css" rel="stylesheet" type="text/css" media="screen"/>
        <link rel="SHORTCUT ICON" type="image/png" href="img/favicon.png" />

        <?php  $this->scripts(); ?>
    </head>
    <body id="doc2">
        <div id="hd" class="yui3-u-1">
            <?php $this->menu(); ?>
        </div>
        <div id="bd" class="yui3-u-1">
        <?php
        $this->content();
        ?>
        <div id="ft" class="yui3-u-1">
            <?php $this->footer(); ?>
        </div>
    </div>
    <?php
    $this->endScripts();
    ?>
    </body>
</html>
<?php $this->end(); ?>
