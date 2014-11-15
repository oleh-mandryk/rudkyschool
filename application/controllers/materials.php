<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Materials extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        redirect (base_url());
    }
    
    public function show($material_id)
    {
        $this->load->library('captcha_lib'); 
        
        //Формуємо елементи, які потрібні в любому випадку
        $data = array();
        
        //масив з пунктами категорій (головне меню);
        $data['menu_main'] = $this->menu_main_model->get_other();
        
        //масив з пунктами верхнього меню;
        $data['menu_top'] = $this->menu_top_model->get_other();
        
        //календар;
        $data['calendar'] = $this->calendar->generate();
        
        //картинки для футера
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //масив по цікаво знати
        $data['i_wonder'] = $this->i_wonder_model->i_wonder($start_from_i_wonder = rand (0, $total = $this->i_wonder_model->count_all()-1));
        
        //масив по цікаво знати
        $data['winged_phrases'] = $this->winged_phrases_model->winged_phrases($start_from_winged_phrases = rand (0, $total = $this->winged_phrases_model->count_all()-1));
        
        //витягуємо з бази всі запитання до голосування
        $data['questions_vote_all']= $this->ques_model->get_other();
        
        //витягуємо з бази всі відповіді для голосування
        $data['options_vote_all']= $this->options_model->get_other();
        
        //витягуємо з бази останні оновлені матеріали
        $data['update_materias']= $this->materials_model->update_materias();
        
        //масив по одній категорії;
        $data['main_info'] = $this->materials_model->get($material_id);
                                
        //Якщо масив пустий
        if (empty($data['main_info']))
        {
            $data['title_info'] = 'Інформаційне повідомлення';
            $data['info'] = 'Такого матеріалу не існує';
            $name = 'info_error';
            $this->display_lib->user_info_page($data,$name);
        }
        else
        {
            //формуємо масив для оновлення поля count_views (поточне число показів матеріалу +1)
            $counter_data = array('count_views' => $data['main_info']['count_views'] + 1);
            
            //Запускаємо функцію оновлення, яка змінює значення лічильника в базі
            $this->materials_model->update_counter($material_id,$counter_data);
                                   
            $name = 'materials/content';
            $this->display_lib->user_page($data,$name);
        }
    }
    
    //Додавання матеріалу
    public function add()
    {
        $this->auth_lib->check_admin();
        
        $this->load->helper('tinymce');
        $this->load->model('sections_model');
        
        $data = array();
        $data['all_sections'] = $this->sections_model->get_other_admin();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
    
        $this->load->library('upload');
        $this->load->library('upload_lib');
        $this->load->library('image_lib');
        $this->load->library('image_small_lib');
    
        //Налаштування
        $settings = $this->upload_lib->get_settings('mini_icon');
        
        //Застосовуємо налаштування
        $this->upload->initialize($settings);
        
        //Якщо натиснута кнопка "Додати"
        if (isset($_POST['add_button']))
        {
            $this->form_validation->set_rules($this->materials_model->add_rules);
            if ($this->form_validation->run() == TRUE)
            {
                if ( ! $this->upload->do_upload())
   	            {
   	                $name='info_error';
   	                $data['info'] = $this->upload->display_errors();
                    $this->display_lib->admin_info_page($data,$name);    
                }
                else
                {
                    $data = array('upload_data' => $this->upload->data());
                    $url_small = $data ['upload_data']['full_path'];
                    $img_name = $data ['upload_data']['file_name'];
                    $width = 35;
                    $height = 35;
                    $settings = $this->image_small_lib->get_settings('mini_icon',$url_small, $width, $height);
                    
                    //Застосовуємо налаштування
                    $this->image_lib->initialize($settings);
                    $this->image_lib->resize();
                    
                    //Добавляємо новий матеріал
                    $this->materials_model->add_photo('mini_icon',$img_name);
                    if ( ! $this->image_lib->resize())
                    {
                        $data['menu_top'] = $this->menu_top_model->get_other();
                        $data['menu_main'] = $this->menu_main_model->get_other();
                        $data['img_footer'] = $this->img_footer_model->get_other();
                        
                        $name='info_error';
                        $data['info'] = $this->image_lib->display_errors();
                        $this->display_lib->admin_info_page($data,$name);  
                    }
                    else
                    {
                        unlink($url_small);
                        
                        $data['menu_top'] = $this->menu_top_model->get_other();
                        $data['menu_main'] = $this->menu_main_model->get_other();
                        $data['img_footer'] = $this->img_footer_model->get_other();
                        
                        $name='info_ok';
                        $data['info'] = 'Матеріал добавлений';
                        $this->display_lib->admin_info_page($data,$name);
                    }
                }
            }
            else
            {
                $name = 'materials/add';
                $this->display_lib->admin_page($data,$name);
            }
        }  
        //Якщо не натиснута кнопка "Додати", виводимо порожню форму
        else
        {   
            $name = 'materials/add';
            $this->display_lib->admin_page($data,$name);            
        }
    }
    
    //Редагування матеріалу (вивід списку матеріалів для вибору)  
    public function edit_list($start_from = 0)
    {
        $this->auth_lib->check_admin();
        
        $data = array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        $this->load->library('pagination');
        $this->load->library('pagination_lib');
        
        //Задаємо обмеження числа матеріалів на сторінку
        $limit = $this->config->item('admin_per_page');
        
        //Рахуємо загальну кількість матеріалів
        $total = $this->materials_model->count_all(); 
        
        //Налаштування (для чого навігація, ім'я для підстановки до base_url, всі, обмеження)
        $settings = $this->pagination_lib->get_settings('material_edit_list','',$total,$limit);
        
        //Застосовуємо налаштування
        $this->pagination->initialize($settings);      
        
        //Список матеріалів
        $data['materials_list'] = $this->materials_model->get_other_pagination_admin($limit,$start_from); 
        
        //Ссилки pagination   
        $data['page_nav'] = $this->pagination->create_links();
        
        $name = 'materials/edit_list';
        $this->display_lib->admin_page($data,$name);
    }
    
    //Редагування матеріалу
    public function edit($material_id = '')
    {
        $this->auth_lib->check_admin();
        
        $this->load->model('sections_model');
        $this->load->helper('tinymce');
        $this->load->helper('radio');    
        
        //Формуємо масив одного матеріалу для відображення у формі редагування
        $data = array();
        
        $data = $this->materials_model->get_admin($material_id);
        $data['all_sections'] = $this->sections_model->get_other();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //Якщо масив порожній
        if (empty($data['material_id']))
        {
            $name='info_error';
            $data['info'] = 'Такого матеріалу не існує';
            $this->display_lib->admin_info_page($data,$name);
        }
        else
        {   
            $data['names'] = $this->materials_model->get_section_values($material_id);
            $data['names_pub'] = $this->materials_model->get_publish_values($material_id);
            $name = 'materials/edit';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //Оновлення матеріалу
    public function update($material_id = '')
    {
        $this->auth_lib->check_admin(); 
        
        $this->load->model('sections_model');
        $this->load->helper('radio');
        $this->load->helper('tinymce');
        
        $data = array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //Якщо натиснута кнопка "Оновити"
        if (isset($_POST['update_button']))
        {
            $this->form_validation->set_rules($this->materials_model->update_rules);
            if ($this->form_validation->run() == TRUE)
            {
                //Оновлюємо матеріал
                $this->materials_model->update($material_id);
                
                $name='info_ok';
                $data['info'] = 'Матеріал оновлений';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                //формуємо масив з даними про матеріал для підстановки в поля форми
                $data = $this->materials_model->get_admin($material_id);
                $data['all_sections'] = $this->sections_model->get_other_admin();
                $data['menu_top'] = $this->menu_top_model->get_other();
                $data['menu_main'] = $this->menu_main_model->get_other();
                $data['img_footer'] = $this->img_footer_model->get_other();
                $data['names'] = $this->materials_model->get_section_values($material_id); 
                $data['names_pub'] = $this->materials_model->get_publish_values($material_id);                             
                
                $name = 'materials/edit';
                $this->display_lib->admin_page($data,$name);
            }
        }
        //Не натиснута кнопка "Оновити"
        else
        {
            $name='info_error';
            $data['info'] = 'Матеріал не був оновлений, томущо Ви не натиснули кнопки "Оновити"';
            $this->display_lib->admin_info_page($data,$name);
        }
    }
    
    //Видалення матеріалу
    public function delete($start_from = 0)
    {
        $this->auth_lib->check_admin();
        
        $this->load->library('pagination');
        $this->load->library('pagination_lib');
        
        $data = array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //Якщо не натиснута кнопка "Видалити"
        if ( ! isset($_POST['delete_button']))
        {
            //Задаємо обмеження числа матеріалів на сторінку 
            $limit = $this->config->item('admin_per_page');
            
            //Рахуємо загальну кількість матеріалів
            $total = $this->materials_model->count_all();
            
            //Налаштування (для чого навігація, ім'я для підстановки до base_url, всі, обмеження)
            $settings = $this->pagination_lib->get_settings('material_delete','',$total,$limit);
            
            //Застосовуємо налаштування
            $this->pagination->initialize($settings);            
        
            //Список матеріалів, розбитий відповідно до pagination   
            $data['materials_list'] = $this->materials_model->get_other_pagination_admin($limit,$start_from); 
            
            //Ссилки pagination
            $data['page_nav'] = $this->pagination->create_links(); 
            
            $name = 'materials/delete';    
            $this->display_lib->admin_page($data,$name);
        }
        //Якщо кнопка "Видалити" натиснута
        else
        {
            //але не вибраний матеріал
            if ( ! isset($_POST['material_id']))
            {
                $name='info_error';
                $data['info'] = 'Не вибраний матеріал для видалення';
                $this->display_lib->admin_info_page($data,$name);        
            }
            //вибраний матеріал
            else 
            {
                $material_id = $this->input->post('material_id');
                $data_del = $this->materials_model->get_admin($material_id);
                if (empty($data_del))
                {
                    $name='info_ok';
                    $data['info'] = 'Фотографія видалена';
                    $this->display_lib->admin_info_page($data, $name);
                }
                else
                {
                    //Видалення фотографії з папки
                    $img_del_small = $data_del['small_img_url'];
                    unlink('./'.$img_del_small);
                }
                
                //Видаляємо матеріал за обраним ідентифікатором
                $this->materials_model->delete($material_id);
                
                $name='info_ok';
                $data['info'] = 'Матеріал видалений';
                $this->display_lib->admin_info_page($data,$name);
            }
        }
    }
}
?>