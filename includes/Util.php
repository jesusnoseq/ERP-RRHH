<?php
class Util {

    public static function print_assoc_array($array, $prefix="", $middle="", $sufix="") {
        if (!is_array($array)) {
            return false;
        }
        foreach ($array as $clave => $valor) {
            $out.= $prefix . $clave . $middle . $valor . $sufix;
        }
        return $out;
    }

    public static function print_array($array, $prefix="", $sufix="") {
        if (!is_array($array)) {
            return false;
        }
        foreach ($array as $valor) {
            $out.=$prefix . $valor . $sufix;
        }
        return $out;
    }

    public static function print_matriz($matriz, $cellPrefix="", $cellSufix="", $rowPrefix="", $rowSufix="") {
        if (!is_array($matriz)) {
            return false;
        }

        foreach ($matriz as $fila) {
            $out.= $rowPrefix . Util::print_array($fila, $cellPrefix, $cellSufix) . $rowSufix;
        }
        return $out;
    }

    public static function print_dataTable($matriz, $keys, $id="datatable", $class="datatable", $caption="") {
        if (!is_array($matriz) || !is_array($keys))
            return NULL;
        $table = "<table id='$id' class='$class'><caption>$caption</caption><tr>";
        foreach ($keys as $key) {
            $table.="<th>$key</th>";
        }
        $table.='</tr>';
        foreach ($matriz as $fila) {
            $table.='<tr>';
            foreach ($fila as $var) {
                $table.="<td>$var</td>";
            }
            $table.='</tr>';
        }
        $table.='</table>';

        return $table;
    }

    public static function getColumn($matriz, $n) {
        if (is_array($matriz)) {
            $column = array();
            foreach ($matriz as $array) {
                if (is_array($array) && count($array) > $n) {
                    $column[] = $array[$n];
                }
            }
            return $column;
        } else {
            return false;
        }
    }

    public static function addKeysToMatriz($keys, $array) {
        $nuevo = array(array());
        if (count($keys) == count($array[0])) {
            for ($i = 0; $i < count($array); $i++) {
                for ($j = 0; $j < count($array[$i]); $j++) {
                    $nuevo[$i][$keys[$j]] = $array[$i][$j];
                }
            }
        }
        return $nuevo;
    }

    public static function addKeysToArray($keys, $array) {
        $nuevo = array();
        if (count($keys) == count($array)) {
            for ($i = 0; $i < count($array); $i++) {
                $nuevo[$keys[$i]] = $array[$i];
            }
        }
        return $nuevo;
    }

    public static function matrizLeftJoin($matrizLeft, $matriz, $joinCol, $newCol, $default=0) {

        $matrizFinal;
        if(!is_array($matrizLeft) || !is_array($matriz))
            return NULL;
        foreach ($matrizLeft as $filaLeft) {
            $found = 0;
            foreach ($matriz as $fila) {
                if ($filaLeft[$joinCol] == $fila[$joinCol]) {
                    $filaLeft[$newCol] = $fila[$newCol];
                    $matrizFinal[] = $filaLeft;
                    $found = 1;
                    break;
                }
            }
            if ($found == 0) {
                $filaLeft[$newCol] = $default;
                $matrizFinal[] = $filaLeft;
            }
        }
        return $matrizFinal;
    }

    public static function getActualPage($mode=1) {
        $actual = $_SERVER['PHP_SELF'];
        if ($mode != 1) {
            $actual = $_SERVER['REQUEST_URI'];
        }
        $array = explode("/", $actual);
//imprime_array($array);
        return $array[count($array) - 1];
    }

    public static function getBrowser() {
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $userAgent = ($_SERVER['HTTP_USER_AGENT']);
            if (preg_match('/opera/i', $userAgent)) {
                return "opera";
            } else if (preg_match('/chrome/i', $userAgent)) {
                return "chrome";
            } else if (preg_match('/MSIE/i', $userAgent)) {
                return "ie";
            } else if (preg_match('/firefox/i', $userAgent)) {
                return 'firefox';
            } else {
                return 'other';
            }
        }


        return false;
    }

    public static function getIP() {
        if (isset($_SERVER['REMOTE_ADDR']))
            return $_SERVER['REMOTE_ADDR'];
        return false;
    }

    public static function comboBox($matriz, $id, $dummy=null, $key1=0, $key2=1) {
        $select = "<select name='$id' id='$id'>";
        if (dummy != null) {
            $select.="<option selected class='dummy'>$dummy</option>";
        }
        foreach ($matriz as $array) {
            if (is_array($array)) {
                $select.="<option value='$array[$key1]'>$array[$key2]</option>";
            } else {
                $select.="<option value='$array'>$array</option>";
            }
        }
        $select.="</select>";
        return $select;
    }

    public static function addScript($src) {
        return "<script type='text/javascript' charset='UTF-8' src='$src'></script>";
    }

    public static function addCSS($src, $media="screen") {
        return "<link href='$src' rel='stylesheet' type='text/css' media='$media'/>";
    }
    
    public static function print_error($msg,$ocultable=false)
    {
        if($ocultable){
            echo '<div class="error">'.$msg.'</div>';
        }else{
            echo '<div class="error ocultable">[ERROR]<BR>'.$msg.'</div>';
        }
    }

}
?>