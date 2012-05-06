<?php

/**
 * Funciones varias para controlar con rapidez y eficacia mysql.
 * @author Jesus Rodriguez perez y otros (buscar en google
 *         "funciones mas usadas para bd").
 * @version 1.2
 */

include "MDBsettings.php";
class MDB {
    private $connect;
    private $result;

    public function __construct($ip=SERVER,$user=USER,$pass=PWD,$db=NAME) {
        define('DBHOST',$ip);
        define('DBUSER',$user);
        define('DBPWD',$pass);
        define('DBNAME',$db);
    }

    function connect($selectDB=true) {
        if( !is_resource($this->connect)) {
            $this->connect=mysql_connect(DBHOST, DBUSER, DBPWD)
                or die ("Error while connecting to database");
            mysql_query ("SET NAMES 'utf8'");
            if($selectDB){
                mysql_select_db(DBNAME,$this->connect)
                    or die ("Error while select database");
            }
        }

        return $this->connect;
    }

    function selectDb(){
        mysql_select_db(DBNAME,$this->connect)
            or die ("Error while select database");
    }

    function consulta($sql) {
        //echo $sql.'<br>';
        $this->result=mysql_query($sql,$this->connect())/*or die();// */or die(mysql_error().'<br>'.$sql);
        
        return $this->result;
    }

    function &getLastResult(){
        mysql_data_seek($this->result, 0);
        return $this->result;
    }


    function close() {
        if( is_resource($this->connect) ) {
            mysql_close($this->connect);
        }
    }

    function fixTables() {
    // search for all the tables of
    // a db and run repair and optimize
    // note: this can take a lot of time
    // if you have big/many tables.
        $result = mysql_list_tables(DBNAME) or die(mysql_error());
        while ($row = mysql_fetch_row($result)) {
            mysql_query("REPAIR TABLE $row[0]");
            mysql_query("OPTIMIZE TABLE $row[0]");
        }
    }

    function getMatriz($result){
        $matriz=array();
        while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
            $matriz[]=$row;
        }
        return $matriz;
    }

    function getColum($result,$colum=0){
        $array=array();
        while ($row = mysql_fetch_array($result)) {
            $array[]=$row[$colum];
        }
        return $array;
    }

    function getHtmlTable($result,$class=NULL,$id=NULL) {
    // receive a record set and print
    // it into an html table
        $out = '<table id="'.$id.'"  class="'.$class.'">';
        $out.='<thead><tr>';
        for($i = 0; $i < mysql_num_fields($result); $i++) {
            $aux = mysql_field_name($result, $i);
            $out .= "<th>".$aux."</th>";
        }
        $out.='</tr></thead>';
        $out.='<tbody>';
        while ($linea = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $out .= "<tr>";
            foreach ($linea as $valor_col) $out .= '<td>'.$valor_col.'</td>';
            $out .= "</tr>";
        }
        $out.='</tbody>';
        $out .= "</table>";
        return $out;
    }

    //nombre de los campos de la tabla
    function getCommaFields( $table, $excepts = "") {
    // get a string with the names of the fields of the $table,
    // except the onews listed in '$excepts' param
        $out = "";
        $result = $this->consulta( "SHOW COLUMNS FROM `$table`");
        while($row = mysql_fetch_array($result)) if ( !stristr(",".$row['Field']."," , $excepts) ) $out.= ($out?",":"").$row['Field'];
        return $out ;
    }

    function getFields($result) {
        $fila = mysql_fetch_array($result, MYSQL_ASSOC);
        mysql_data_seek($result,0);
        return array_keys($fila) ;
    }

    //primeros valores de cada fila separados por comas
    function getCommaValues($sql) {
    // execute a $sql query and return
    // all the first value of the rows in
    // a comma separated string
        $out = "";
        $rs = $this->consulta($sql);
        while($r=mysql_fetch_row($rs)) $out.=($out?",":"").$r[0];
        return $out;
    }

    function getEnumSetValues( $table , $field ) {
    // get an array of the allowed values
    // of the enum or set $field of $table
        $query = "SHOW COLUMNS FROM `$table` LIKE '$field'";
        $result = $this->consulta( $query );
        $row = mysql_fetch_array($result);
        if(stripos(".".$row[1],"enum(") > 0) $row[1]=str_replace("enum('","",$row[1]);
        else $row[1]=str_replace("set('","",$row[1]);
        $row[1]=str_replace("','","\n",$row[1]);
        $row[1]=str_replace("')","",$row[1]);
        $ar = explode("\n",$row[1]);
        for ($i=0;$i<count($ar);$i++) $arOut[str_replace("''","'",$ar[$i])]=str_replace("''","'",$ar[$i]);
        return $arOut ;
    }
    
    //el primer valor de una consulta, biene bien para los count
    function getScalar($sql,$def="",$colum=0) {
    // execute a $sql query and return the first
    // value, or, if none, the $def value
        $rs = $this->consulta( $sql );
        if(!is_bool($rs)){
            if (mysql_num_rows($rs)) {
                $r = mysql_fetch_row($rs);
                mysql_free_result($rs);
                return $r[$colum];
            }
        }
        return $def;
    }


    function existBD($bd) {
        //  comprobamos que la bd no existe        
        $bd_List=mysql_list_dbs($this->connect(false));
        $bd=strtolower($bd);
        $existe=FALSE;
        for($i=0;$i<mysql_num_rows($bd_List);$i++) {
            if(mysql_db_name($bd_List,$i)==$bd) {
                $existe=TRUE;
                break;
            }
        }
        
        return $existe;
    }

    function tablaEnUso($tabla)
    {
        $sql="SHOW OPEN TABLES from ".DBNAME." like '$tabla'";
        return $this->getScalar($sql,0,2);
    }

}
?>
