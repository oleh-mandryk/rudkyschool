<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//ϳ�������� ��� tinymce - ������� javascript � ��������� ���� ���
function get_tinymce()
{
    $CI =& get_instance();
    $code = $CI->load->view('tinymce','',TRUE);
    return $code;
}

?>