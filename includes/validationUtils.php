<?php
// funciones de expresiones regulares utiles


function esTelefono($telefono) {
    return ereg("/^\d{9}$/", $telefono);
}


function esTelfMovil($telefono)
{
    return ereg("^6[0-9]{8}$", $telefono);
}


function esFecha($fecha)
{
    return ereg("^([0-9]{1,2})/([0-9]{1,2}/([0-9]{4}))$", $fecha);
}

function esTipoParte($tp){
    return ereg("^[A|D|P]{1}$", $tp);
}

// --------------------------------------------------------------------

function dni($dni) {
    $letras =array('T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N',
        'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T');
    if( ! preg_match('/^\d{8}[A-Z]$/',$dni) ) {
        return false;
    }
    return !( $dni{8} != $letras[substr($dni, 0,8)%23]);
}


// --------------------------------------------------------------------

function inLength($str,$min,$max) {
    return (strlen($str)>=$min && strlen($str)<=$max) ? FALSE : TRUE;
}



//                        funciones de validacion de code igniter
// --------------------------------------------------------------------

/**
 * Minimum Length
 *
 * @access	public
 * @param	string
 * @param	value
 * @return	bool
 */
function min_length($str, $val) {
    if (preg_match("/[^0-9]/", $val)) {
        return FALSE;
    }

    return (strlen($str) < $val) ? FALSE : TRUE;
}

// --------------------------------------------------------------------

/**
 * Max Length
 *
 * @access	public
 * @param	string
 * @param	value
 * @return	bool
 */
function max_length($str, $val) {
    if (preg_match("/[^0-9]/", $val)) {
        return FALSE;
    }

    return (strlen($str) > $val) ? FALSE : TRUE;
}

// --------------------------------------------------------------------

/**
 * Exact Length
 *
 * @access	public
 * @param	string
 * @param	value
 * @return	bool
 */
function exact_length($str, $val) {
    if (preg_match("/[^0-9]/", $val)) {
        return FALSE;
    }

    return (strlen($str) != $val) ? FALSE : TRUE;
}

// --------------------------------------------------------------------

/**
 * Valid Email
 *
 * @access	public
 * @param	string
 * @return	bool
 */
function valid_email($str) {
    return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
}

// --------------------------------------------------------------------

/**
 * Alpha
 *
 * @access	public
 * @param	string
 * @return	bool
 */
function alpha($str) {
    return ( ! preg_match("/^([a-z])+$/i", $str)) ? FALSE : TRUE;
}

// --------------------------------------------------------------------

/**
 * Alpha-numeric
 *
 * @access	public
 * @param	string
 * @return	bool
 */
function alpha_numeric($str) {
    return ( ! preg_match("/^([a-z0-9])+$/i", $str)) ? FALSE : TRUE;
}

// --------------------------------------------------------------------

/**
 * Alpha-numeric with underscores and dashes
 *
 * @access	public
 * @param	string
 * @return	bool
 */
function alpha_dash($str) {
    return ( ! preg_match("/^([-a-z0-9_-])+$/i", $str)) ? FALSE : TRUE;
}

// --------------------------------------------------------------------

/**
 * Numeric
 *
 * @access	public
 * @param	string
 * @return	bool
 */
function numeric($str) {
    return (bool)preg_match( '/^[\-+]?[0-9]*\.?[0-9]+$/', $str);

}

// --------------------------------------------------------------------

/**
 * Integer
 *
 * @access	public
 * @param	string
 * @return	bool
 */
function integer($str) {
    return (bool)preg_match( '/^[\-+]?[0-9]+$/', $str);
}

// --------------------------------------------------------------------

/**
 * Is a Natural number  (0,1,2,3, etc.)
 *
 * @access	public
 * @param	string
 * @return	bool
 */
function is_natural($str) {
    return (bool)preg_match( '/^[0-9]+$/', $str);
}

// --------------------------------------------------------------------

/**
 * Is a Natural number, but not a zero  (1,2,3, etc.)
 *
 * @access	public
 * @param	string
 * @return	bool
 */
function is_natural_no_zero($str) {
    if ( ! preg_match( '/^[0-9]+$/', $str)) {
        return FALSE;
    }

    if ($str == 0) {
        return FALSE;
    }

    return TRUE;
}

// --------------------------------------------------------------------

/**
 * Valid Base64
 *
 * Tests a string for characters outside of the Base64 alphabet
 * as defined by RFC 2045 http://www.faqs.org/rfcs/rfc2045
 *
 * @access	public
 * @param	string
 * @return	bool
 */
function valid_base64($str) {
    return (bool) ! preg_match('/[^a-zA-Z0-9\/\+=]/', $str);
}



?>
