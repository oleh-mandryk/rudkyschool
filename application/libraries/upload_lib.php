<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Upload_lib
{
    public function get_settings($id)
    {
        $config = array();
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = FALSE;
        $config['max_size'] = '500';
        $config['max_width'] = '768';
        $config['max_height'] = '1024';
        $config['encrypt_name'] = TRUE;
        $config['remove_spaces'] = TRUE;
        
        switch($id)
        {
            //якщо закачуЇтьс€ зображенн€ фотогалерењ
            case 'photogallery':
                $config['upload_path'] = './img/photogallery/big/';
                return $config;
                break;
            
            //якщо закачуЇтьс€ зображенн€ м≥н≥-≥конки дл€ матер≥алу
            case 'mini_icon':
                $config['upload_path'] = './img/big_img_material/';
                return $config;
                break;
                
                //якщо закачуЇтьс€ зображенн€ м≥н≥-≥конки дл€ матер≥алу
            case 'img_footer':
                $config['upload_path'] = './img/big_img_footer/';
                return $config;
                break;
                
      }
    }
}
?>