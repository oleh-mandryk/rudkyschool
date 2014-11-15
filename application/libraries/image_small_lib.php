<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Image_small_lib
{
    public function get_settings($id, $url_small, $width, $height)
    {
        $config = array();
        $config['image_library'] = 'GD2';
        $config['quality'] = '100%';
               
        switch($id)
        {
            //���� ������� ���������� ����������
            case 'photogallery':
                $config['source_image'] = $url_small;
                $config['new_image'] = './img/photogallery/small/';
                $config['width'] = $width;
                $config['height'] = $height;
                $config['maintain_ratio'] = TRUE;
                
                return $config;
                break;
            
            //���� ������� ���������� ��-������ ��� ��������
            case 'mini_icon':
                $config['source_image'] = $url_small;
                $config['new_image'] = './img/small_img_material/';
                $config['width'] = $width;
                $config['height'] = $height;     
                $config['maintain_ratio'] = FALSE;
                return $config;
                break;
                
                //���� ������� ���������� ��� ������
            case 'img_footer':
                $config['source_image'] = $url_small;
                $config['new_image'] = './img/small_img_footer/';
                $config['width'] = $width;
                $config['height'] = $height;     
                $config['maintain_ratio'] = TRUE;
                return $config;
                break;
        }
    }
}
?>