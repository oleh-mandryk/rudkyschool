<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pagination_lib
{
    //id - дл€ чого нав≥гац≥€, name - дл€ п≥дставленн€ до base_url(т≥льки дл€ категор≥й), всього, обмеженн€
    public function get_settings($id,$name,$total,$limit)
    {
        $config = array();
        $config['total_rows'] = $total;
        $config['per_page'] = $limit;
        $config['first_link'] = '&laquo;ѕерша';
        $config['last_link'] = 'ќстанн€&raquo;';
        $config['next_link'] = '&raquo;';
        $config['prev_link'] = '&laquo;';
        
        // открывющий тэг перед навигацией
        $config['full_tag_open'] = '<ul id="pagination">';
        
        // закрывающий тэг после навигации 
        $config['full_tag_close'] = '</ul>';
        
        // перва€ страница открывающий тэг 
        $config['first_tag_open'] = '<li>'; 
        
        // перва€ страница закрывающий тэг 
        $config['first_tag_close'] = '</li>';
        
        // последн€€ страница открывающий тэг 
        $config['last_tag_open'] = '<li>'; 
        
        // последн€€ страница закрывающий тэг
        $config['last_tag_close'] = '</li>'; 
        
        // предыдуща€ страница открывающий тэг
        $config['prev_tag_open'] = '<li>';
        
        // предыдуща€ страница закрывающий тэг 
        $config['prev_tag_close'] = '</li>';
        
        // текуща€ страница открывающий тэг
        $config['cur_tag_open'] = '<li class = "active">'; 
        
        // текуща€ страница закрывающий тэг
        $config['cur_tag_close'] = '</li>';
            
        $config['num_tag_open'] = '<li>'; // цифрова€ ссылка открывающий тэг
        $config['num_tag_close'] = '</li>'; // цифрова€ ссылка закрывающий тэг
        
        // следующа€ страница открывающий тэг
        $config['next_tag_open'] = '<li>'; 
        
        // следующа€ страница закрывающий тэг
        $config['next_tag_close'] = '</li>';        
        
        switch($id)
        {
            //якщо нав≥гац≥€ дл€ категор≥й
            case 'section':
                $config['base_url'] = base_url().'sections/show/'.$name;
                $config['uri_segment'] = 4;
                // ≥льк≥сть "цифрових" ссилок по бокам в≥д вибраноњ
                $config['num_links'] = 2;
                return $config;
                break;
                
                //якщо нав≥гац≥€ дл€ категор≥й фотогалерењ
            case 'photogallery_section':
                $config['base_url'] = base_url().'photogallery_sections/show/'.$name;
                $config['uri_segment'] = 4;
                // ≥льк≥сть "цифрових" ссилок по бокам в≥д вибраноњ
                $config['num_links'] = 2;
                return $config;
                break;
            
            //якщо нав≥гац≥€ дл€ пошуку
            case 'search':
                $config['base_url'] = base_url().'search/';
                $config['uri_segment'] = 2;
                $config['num_links'] = 2;
                return $config;
                break;
                
            //якщо нав≥гац≥€ дл€ матер≥ал≥в (список дл€ редагуванн€ в адм≥нц≥)
            case 'material_edit_list':
                $config['base_url'] = base_url().'materials/edit_list/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
               
            //якщо нав≥гац≥€ дл€ матер≥ал≥в (список дл€ видаленн€ в адм≥нц≥)
            case 'material_delete':
                $config['base_url'] = base_url().'materials/delete/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
                
                //якщо нав≥гац≥€ дл€ крилатих фраз (список дл€ редагуванн€ в адм≥нц≥)
            case 'winged_phrases_edit_list':
                $config['base_url'] = base_url().'winged_phrases/edit_list/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
                
                //якщо нав≥гац≥€ дл€ крилатих фраз (список дл€ редагуванн€ в адм≥нц≥)
            case 'winged_phrases_delete':
                $config['base_url'] = base_url().'winged_phrases/delete/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
                
                //якщо нав≥гац≥€ дл€ ц≥каво знати (список дл€ редагуванн€ в адм≥нц≥)
            case 'i_wonder_edit_list':
                $config['base_url'] = base_url().'i_wonder/edit_list/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
                
                //якщо нав≥гац≥€ дл€ ц≥каво знати (список дл€ редагуванн€ в адм≥нц≥)
            case 'i_wonder_delete':
                $config['base_url'] = base_url().'i_wonder/delete/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
                
                //якщо нав≥гац≥€ дл€ ц≥каво знати (список дл€ редагуванн€ в адм≥нц≥)
            case 'schedule_edit_list':
                $config['base_url'] = base_url().'schedule/edit_list_schedule/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
                
                //якщо нав≥гац≥€ дл€ ц≥каво знати (список дл€ редагуванн€ в адм≥нц≥)
            case 'schedule_delete':
                $config['base_url'] = base_url().'schedule/delete_schedule/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
                
                //якщо нав≥гац≥€ дл€ фотогалерењ (список дл€ редагуванн€ в адм≥нц≥)
            case 'photogallery_edit_list':
                $config['base_url'] = base_url().'photogallery_photos/edit_list/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
                
                //якщо нав≥гац≥€ дл€ фотогалерењ (список дл€ редагуванн€ в адм≥нц≥)
            case 'photogallery_delete':
                $config['base_url'] = base_url().'photogallery_photos/delete/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
                
                //якщо нав≥гац≥€ дл€ зображень футера (список дл€ редагуванн€ в адм≥нц≥)
            case 'footer_edit_list':
                $config['base_url'] = base_url().'footer_img/edit_list/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
                
                //якщо нав≥гац≥€ дл€ зображень футера (список дл€ редагуванн€ в адм≥нц≥)
            case 'footer_delete':
                $config['base_url'] = base_url().'footer_img/delete/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
                
                //якщо нав≥гац≥€ дл€ методичних матер≥ал≥в учн€ (список дл€ редагуванн€ в адм≥нц≥)
            case 'pupils_edit_list':
                $config['base_url'] = base_url().'methodical_materials/edit_list_pupils/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
                
                //якщо нав≥гац≥€ дл€ методичних матер≥ал≥в учн€ (список дл€ редагуванн€ в адм≥нц≥)
            case 'pupils_delete':
                $config['base_url'] = base_url().'methodical_materials/delete_pupils/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
                
                //якщо нав≥гац≥€ дл€ методичних матер≥ал≥в вчител€ (список дл€ редагуванн€ в адм≥нц≥)
            case 'teachers_edit_list':
                $config['base_url'] = base_url().'methodical_materials/edit_list_teachers/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
                
                //якщо нав≥гац≥€ дл€ методичних матер≥ал≥в вчител€ (список дл€ редагуванн€ в адм≥нц≥)
            case 'teachers_delete':
                $config['base_url'] = base_url().'methodical_materials/delete_teachers/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
        }
    }
}
?>