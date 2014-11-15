<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Upload_materials_lib
{
    public function get_settings($id)
    {
        $config = array();
        $config['allowed_types'] = 'zip';
        $config['overwrite'] = FALSE;
        $config['max_size'] = '8192';
        $config['encrypt_name'] = TRUE;
        $config['remove_spaces'] = TRUE;
        
        switch($id)
        {
            //якщо закачуЇтьс€ файл дл€ учн≥в
            case 'pupils_materials':
                $config['upload_path'] = './files/pupils_materials/';
                return $config;
                break;
            
            //якщо закачуЇтьс€ файл дл€ вчител≥в
            case 'teachers_materials':
                $config['upload_path'] = './files/teachers_materials/';
                return $config;
                break;
      }
    }
}
?>