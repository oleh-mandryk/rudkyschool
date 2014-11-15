<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Photogallery extends CI_Controller
{
    public function index()
    {
       redirect (base_url());
    }
    
    public function photogallery_main()
    {
        $this->load->model('photogallery_sections_model');
        $this->load->model('photogallery_photos_model');
        
        $this->photogallery_photos_model->count_photo($start = 0);
        $this->photogallery_photos_model->photo_title($start = 0);
        
        //формуЇмо масив дл€ передаванн€ у вид;
        $data=array();
        
        //масив з пунктами категор≥й (головне меню);
        $data['menu_main'] = $this->menu_main_model->get_other();
        
        //масив з пунктами верхнього меню;
        $data['menu_top'] = $this->menu_top_model->get_other();
        
        //картинки дл€ футера
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //масив по ц≥каво знати
        $data['i_wonder'] = $this->i_wonder_model->i_wonder($start_from_i_wonder = rand (0, $total = $this->i_wonder_model->count_all()-1));
        
        //масив по ц≥каво знати
        $data['winged_phrases'] = $this->winged_phrases_model->winged_phrases($start_from_winged_phrases = rand (0, $total = $this->winged_phrases_model->count_all()-1));
        
        //вит€гуЇмо з бази вс≥ запитанн€ до голосуванн€
        $data['questions_vote_all']= $this->ques_model->get_other();
        
        //вит€гуЇмо з бази вс≥ в≥дпов≥д≥ дл€ голосуванн€
        $data['options_vote_all']= $this->options_model->get_other();
        
        //вит€гуЇмо з бази останн≥ оновлен≥ матер≥али
        $data['update_materias']= $this->materials_model->update_materias();
                
        $data['all_photogallery_sections'] = $this->photogallery_sections_model->get_other();
        
        $data['title_info']='‘отогалере€';
        $name = 'photogallery/photogallery_main';
        $this->display_lib->user_info_page($data,$name);
    }
}
?>