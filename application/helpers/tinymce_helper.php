<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Підгружаємо вид tinymce - простий javascript і повертаємо його код
function get_tinymce()
{
    $CI =& get_instance();
    $code = $CI->load->view('tinymce','',TRUE);
    return $code;
}

?>