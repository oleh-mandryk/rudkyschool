<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Methodical_materials extends CI_Controller
{
    public function index()
    {
       redirect (base_url());
    }
    
    public function methodical_materials_pupils()
    {
        $this->load->helper('radio');
        $this->load->model('methodical_materials_pupils_model');
                        
        //формуємо масив для передавання у вид;
        $data=array();
        
        //масив з пунктами категорій (головне меню);
        $data['menu_main'] = $this->menu_main_model->get_other();
        
        //масив з пунктами верхнього меню;
        $data['menu_top'] = $this->menu_top_model->get_other();
        
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
        
        if ((isset($_POST['pupils_class']))AND(empty($_POST['pupils_subject'])))
        {
            $class_ok = $this->input->post('pupils_class');
            $data['all_subject'] = $this->methodical_materials_pupils_model->all_subject($class_ok);
            
            $data['names_sel'] = $this->input->post('pupils_class');
            $data['title_info']='Методичні матеріали учням';
            $name = 'methodical_materials/methodical_materials_pupils';
            $this->display_lib->user_info_page($data,$name);
        }
        else
        {
            if ((isset($_POST['pupils_class']))AND(isset($_POST['pupils_subject'])))
            {
                $class_ok = $this->input->post('pupils_class');
                $data['all_subject'] = $this->methodical_materials_pupils_model->all_subject($class_ok);
                
                $data['names_sel'] = $this->input->post('pupils_class');
                $data['names_sel_1'] = $this->input->post('pupils_subject');
                
                $class_get = $this->input->post('pupils_class');
                $subject_get = $this->input->post('pupils_subject');
                
                $data['all_methodical_materials'] = $this->methodical_materials_pupils_model->all_methodical_materials($class_get, $subject_get);
                $data['title_info']='Методичні матеріали учням';
                $name = 'methodical_materials/methodical_materials_pupils';
                $this->display_lib->user_info_page($data,$name);
            }
            else
            {
                $data['names_sel']='';
                $data['title_info']='Методичні матеріали учням';
                $name = 'methodical_materials/methodical_materials_pupils';
                $this->display_lib->user_info_page($data,$name);
            }
        }
    }
    
    public function methodical_materials_teachers()
    {
        $this->load->helper('radio');
        $this->load->model('methodical_materials_teachers_model');
                        
        //формуємо масив для передавання у вид;
        $data=array();
        
        //масив з пунктами категорій (головне меню);
        $data['menu_main'] = $this->menu_main_model->get_other();
        
        //масив з пунктами верхнього меню;
        $data['menu_top'] = $this->menu_top_model->get_other();
        
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
        
        if ((isset($_POST['teachers_class']))AND(empty($_POST['teachers_subject'])))
        {
            $class_ok = $this->input->post('teachers_class');
            $data['all_subject'] = $this->methodical_materials_teachers_model->all_subject($class_ok);
            
            $data['names_sel'] = $this->input->post('teachers_class');
            $data['title_info']='Методичні матеріали вчителям';
            $name = 'methodical_materials/methodical_materials_teachers';
            $this->display_lib->user_info_page($data,$name);
        }
        else
        {
            if ((isset($_POST['teachers_class']))AND(isset($_POST['teachers_subject'])))
            {
                $class_ok = $this->input->post('teachers_class');
                $data['all_subject'] = $this->methodical_materials_teachers_model->all_subject($class_ok);
                
                $data['names_sel'] = $this->input->post('teachers_class');
                $data['names_sel_1'] = $this->input->post('teachers_subject');
                
                $class_get = $this->input->post('teachers_class');
                $subject_get = $this->input->post('teachers_subject');
                
                $data['all_methodical_materials'] = $this->methodical_materials_teachers_model->all_methodical_materials($class_get, $subject_get);
                $data['title_info']='Методичні матеріали вчителям';
                $name = 'methodical_materials/methodical_materials_teachers';
                $this->display_lib->user_info_page($data,$name);
            }
            else
            {
                $data['names_sel']='';
                $data['title_info']='Методичні матеріали вчителям';
                $name = 'methodical_materials/methodical_materials_teachers';
                $this->display_lib->user_info_page($data,$name);
            }
        }
    }
    
    //Додавання методичного метеріалу
    public function add_pupils()
    {
        $this->auth_lib->check_admin();
        
        $this->load->model('methodical_materials_pupils_model');
        
        $data=array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        $this->load->library('upload');
        $this->load->library('upload_materials_lib');
        
        //Налаштування 
        $settings = $this->upload_materials_lib->get_settings('pupils_materials');
               
        //Применяем настройки
        $this->upload->initialize($settings);
        
        //Якщо натиснута кнопка "Додати"  
        if (isset($_POST['add_button']))      
        {
            $this->form_validation->set_rules($this->methodical_materials_pupils_model->add_rules);
            
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
                    $material_name = $data ['upload_data']['file_name'];
                    
                    //Додаємо новий методичний матеріал
                    $this->methodical_materials_pupils_model->add_material('pupils_materials',$material_name);
                                        
                    $data['menu_top'] = $this->menu_top_model->get_other();
                    $data['menu_main'] = $this->menu_main_model->get_other();
                    $data['img_footer'] = $this->img_footer_model->get_other();
                    
                    $name='info_ok';
                    $data['info'] = 'Методичний матеріал успішно добавлений';
                    $this->display_lib->admin_info_page($data,$name);
                }
            }
            else
            {
                $name = 'methodical_materials_pupils/add';
                //Передаємо пустий масив data так, як цього потребує функція admin_page 
                $this->display_lib->admin_page($data,$name);           
            }
        }
              
        //Якщо не натиснута кнопка "Додати", виводимо порожню форму
        else
        {                      
            $name = 'methodical_materials_pupils/add';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //Редагування методичного матеріалу (вивід списку методичних матеріалів для вибору)  
    public function edit_list_pupils($start_from = 0)
    {
        $this->auth_lib->check_admin();
        $this->load->model('methodical_materials_pupils_model');
        
        $data = array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        $this->load->library('pagination');
        $this->load->library('pagination_lib');
        
        //Задаємо обмеження числа методичних матеріалів на сторінку
        $limit = $this->config->item('admin_per_page');
        
        //Рахуємо загальну кількість методичних матеріалів
        $total = $this->methodical_materials_pupils_model->count_all(); 
        
        //Налаштування (для чого навігація, ім'я для підстановки до base_url, всі, обмеження)
        $settings = $this->pagination_lib->get_settings('pupils_edit_list','',$total,$limit);
        
        //Застосовуємо налаштування
        $this->pagination->initialize($settings);      
        
        //Список уроків
        $data['pupils_list'] = $this->methodical_materials_pupils_model->get_other_pagination_admin($limit,$start_from); 
        
        //Ссилки pagination   
        $data['page_nav'] = $this->pagination->create_links();
        
        $name = 'methodical_materials_pupils/edit_list';
        $this->display_lib->admin_page($data,$name);
    }
    
    //Редагування методичного матеріалу
    public function edit_pupils($methodical_materials_pupils_id = '')
    {
        $this->auth_lib->check_admin();
        
        $this->load->model('methodical_materials_pupils_model');
        $this->load->helper('radio');    
                
        //Формуємо масив одного методичного матеріалу для відображення у формі редагування
        $data = array();
        
        $data = $this->methodical_materials_pupils_model->get_admin($methodical_materials_pupils_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //Якщо масив порожній
        if (empty($data['methodical_materials_pupils_id']))
        {
            $name='info_error';
            $data['info'] = 'Такого методичного матеріалу не існує';
            $this->display_lib->admin_info_page($data,$name);
        }
        else
        {   
            $data['names_pub'] = $this->methodical_materials_pupils_model->get_publish_values($methodical_materials_pupils_id);
            $data['names_sel'] = $this->methodical_materials_pupils_model->get_class_values($methodical_materials_pupils_id);
            $name = 'methodical_materials_pupils/edit';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //Оновлення методичного матеріалу
    public function update_pupils($methodical_materials_pupils_id = '')
    {
        $this->auth_lib->check_admin(); 
        
        $this->load->model('methodical_materials_pupils_model');
        $this->load->helper('radio');
                
        $data = array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //Якщо натиснута кнопка "Оновити"
        if (isset($_POST['update_button']))
        {
            $this->form_validation->set_rules($this->methodical_materials_pupils_model->update_rules);
            if ($this->form_validation->run() == TRUE)
            {
                //Оновлюємо методичний матеріал
                $this->methodical_materials_pupils_model->update($methodical_materials_pupils_id);
                
                $name='info_ok';
                $data['info'] = 'Методичний матеріал оновлений';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                //формуємо масив з даними про методичний матеріал для підстановки в поля форми
                $data = $this->methodical_materials_pupils_model->get_admin($methodical_materials_pupils_id);
                $data['menu_top'] = $this->menu_top_model->get_other();
                $data['menu_main'] = $this->menu_main_model->get_other();
                $data['img_footer'] = $this->img_footer_model->get_other();
                $data['names_pub'] = $this->methodical_materials_pupils_model->get_publish_values($methodical_materials_pupils_id);                             
                
                $name = 'methodical_materials_pupils/edit';
                $this->display_lib->admin_page($data,$name);
            }
        }
        //Не натиснута кнопка "Оновити"
        else
        {
            $name='info_error';
            $data['info'] = 'Методичний матеріал не був оновлений, томущо Ви не натиснули кнопки "Оновити"';
            $this->display_lib->admin_info_page($data,$name);
        }
    }
    
    //Видалення методичного матеріалу
    public function delete_pupils($start_from = 0)
    {
        $this->auth_lib->check_admin();
        $this->load->model('methodical_materials_pupils_model');
        
        $this->load->library('pagination');
        $this->load->library('pagination_lib');
        
        $data = array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //Якщо не натиснута кнопка "Видалити"
        if ( ! isset($_POST['delete_button']))
        {
            //Задаємо обмеження числа методичних матеріалів на сторінку 
            $limit = $this->config->item('admin_per_page');
            
            //Рахуємо загальну кількість методичних матеріалів
            $total = $this->methodical_materials_pupils_model->count_all();
            
            //Налаштування (для чого навігація, ім'я для підстановки до base_url, всі, обмеження)
            $settings = $this->pagination_lib->get_settings('pupils_delete','',$total,$limit);
            
            //Застосовуємо налаштування
            $this->pagination->initialize($settings);            
        
            //Список методичних матеріалів, розбитий відповідно до pagination   
            $data['pupils_list'] = $this->methodical_materials_pupils_model->get_other_pagination_admin($limit,$start_from); 
            
            //Ссилки pagination
            $data['page_nav'] = $this->pagination->create_links(); 
            
            $name = 'methodical_materials_pupils/delete';    
            $this->display_lib->admin_page($data,$name);
        }
        //Якщо кнопка "Видалити" натиснута
        else
        {
            //але не вибраний методичний матеріал
            if ( ! isset($_POST['methodical_materials_pupils_id']))
            {
                $name='info_error';
                $data['info'] = 'Не вибраний методичний матеріал для видалення';
                $this->display_lib->admin_info_page($data,$name);        
            }
            //вибраний методичний матеріал для видалення
            else 
            {
                //Отримуємо ідентифікатор методичного матеріалу з масиву POST
                $methodical_materials_pupils_id = $this->input->post('methodical_materials_pupils_id');
                $data_del = $this->methodical_materials_pupils_model->get($methodical_materials_pupils_id);
                
                if (empty($data_del))
                {
                    $data['info'] = 'Методичний матеріал видалений';
                    $name='info_ok';
                    $this->display_lib->admin_info_page($data,$name);
                }
                else
                {
                    //Видалення методичного матеріалу з папки
                    $img_del = $data_del['url_material'];
                    unlink('./'.$img_del);
                    
                }
                
                //Видаляємо методичний матеріал з вибраним ідентифікатором
                $this->methodical_materials_pupils_model->delete($methodical_materials_pupils_id);           
                $name='info_ok';
                $data['info'] = 'Методичний матеріал видалений';
                $this->display_lib->admin_info_page($data,$name);
            }
        }
    }
    
    //Додавання методичного метеріалу
    public function add_teachers()
    {
        $this->auth_lib->check_admin();
        
        $this->load->model('methodical_materials_teachers_model');
        
        $data=array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        $this->load->library('upload');
        $this->load->library('upload_materials_lib');
        
        //Налаштування 
        $settings = $this->upload_materials_lib->get_settings('teachers_materials');
               
        //Применяем настройки
        $this->upload->initialize($settings);
        
        //Якщо натиснута кнопка "Додати"  
        if (isset($_POST['add_button']))      
        {
            $this->form_validation->set_rules($this->methodical_materials_teachers_model->add_rules);
            
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
                    $material_name = $data ['upload_data']['file_name'];
                    
                    //Додаємо новий методичний матеріал
                    $this->methodical_materials_teachers_model->add_material('teachers_materials',$material_name);
                                        
                    $data['menu_top'] = $this->menu_top_model->get_other();
                    $data['menu_main'] = $this->menu_main_model->get_other();
                    $data['img_footer'] = $this->img_footer_model->get_other();
                    
                    $name='info_ok';
                    $data['info'] = 'Методичний матеріал успішно добавлений';
                    $this->display_lib->admin_info_page($data,$name);
                }
            }
            else
            {
                $name = 'methodical_materials_teachers/add';
                //Передаємо пустий масив data так, як цього потребує функція admin_page 
                $this->display_lib->admin_page($data,$name);           
            }
        }
              
        //Якщо не натиснута кнопка "Додати", виводимо порожню форму
        else
        {                      
            $name = 'methodical_materials_teachers/add';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //Редагування методичного матеріалу (вивід списку методичних матеріалів для вибору)  
    public function edit_list_teachers($start_from = 0)
    {
        $this->auth_lib->check_admin();
        $this->load->model('methodical_materials_teachers_model');
        
        $data = array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        $this->load->library('pagination');
        $this->load->library('pagination_lib');
        
        //Задаємо обмеження числа методичних матеріалів на сторінку
        $limit = $this->config->item('admin_per_page');
        
        //Рахуємо загальну кількість методичних матеріалів
        $total = $this->methodical_materials_teachers_model->count_all(); 
        
        //Налаштування (для чого навігація, ім'я для підстановки до base_url, всі, обмеження)
        $settings = $this->pagination_lib->get_settings('teachers_edit_list','',$total,$limit);
        
        //Застосовуємо налаштування
        $this->pagination->initialize($settings);      
        
        //Список уроків
        $data['teachers_list'] = $this->methodical_materials_teachers_model->get_other_pagination_admin($limit,$start_from); 
        
        //Ссилки pagination   
        $data['page_nav'] = $this->pagination->create_links();
        
        $name = 'methodical_materials_teachers/edit_list';
        $this->display_lib->admin_page($data,$name);
    }
    
    //Редагування методичного матеріалу
    public function edit_teachers($methodical_materials_teachers_id = '')
    {
        $this->auth_lib->check_admin();
        
        $this->load->model('methodical_materials_teachers_model');
        $this->load->helper('radio');    
                
        //Формуємо масив одного методичного матеріалу для відображення у формі редагування
        $data = array();
        
        $data = $this->methodical_materials_teachers_model->get_admin($methodical_materials_teachers_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //Якщо масив порожній
        if (empty($data['methodical_materials_teachers_id']))
        {
            $name='info_error';
            $data['info'] = 'Такого методичного матеріалу не існує';
            $this->display_lib->admin_info_page($data,$name);
        }
        else
        {   
            $data['names_pub'] = $this->methodical_materials_teachers_model->get_publish_values($methodical_materials_teachers_id);
            $data['names_sel'] = $this->methodical_materials_teachers_model->get_class_values($methodical_materials_teachers_id);
            $name = 'methodical_materials_teachers/edit';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //Оновлення методичного матеріалу
    public function update_teachers($methodical_materials_teachers_id = '')
    {
        $this->auth_lib->check_admin(); 
        
        $this->load->model('methodical_materials_teachers_model');
        $this->load->helper('radio');
                
        $data = array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //Якщо натиснута кнопка "Оновити"
        if (isset($_POST['update_button']))
        {
            $this->form_validation->set_rules($this->methodical_materials_teachers_model->update_rules);
            if ($this->form_validation->run() == TRUE)
            {
                //Оновлюємо методичний матеріал
                $this->methodical_materials_teachers_model->update($methodical_materials_teachers_id);
                
                $name='info_ok';
                $data['info'] = 'Методичний матеріал оновлений';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                //формуємо масив з даними про методичний матеріал для підстановки в поля форми
                $data = $this->methodical_materials_teachers_model->get_admin($methodical_materials_teachers_id);
                $data['menu_top'] = $this->menu_top_model->get_other();
                $data['menu_main'] = $this->menu_main_model->get_other();
                $data['img_footer'] = $this->img_footer_model->get_other();
                $data['names_pub'] = $this->methodical_materials_teachers_model->get_publish_values($methodical_materials_teachers_id);                             
                
                $name = 'methodical_materials_teachers/edit';
                $this->display_lib->admin_page($data,$name);
            }
        }
        //Не натиснута кнопка "Оновити"
        else
        {
            $name='info_error';
            $data['info'] = 'Методичний матеріал не був оновлений, томущо Ви не натиснули кнопки "Оновити"';
            $this->display_lib->admin_info_page($data,$name);
        }
    }
    
    //Видалення методичного матеріалу
    public function delete_teachers($start_from = 0)
    {
        $this->auth_lib->check_admin();
        $this->load->model('methodical_materials_teachers_model');
        
        $this->load->library('pagination');
        $this->load->library('pagination_lib');
        
        $data = array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //Якщо не натиснута кнопка "Видалити"
        if ( ! isset($_POST['delete_button']))
        {
            //Задаємо обмеження числа методичних матеріалів на сторінку 
            $limit = $this->config->item('admin_per_page');
            
            //Рахуємо загальну кількість методичних матеріалів
            $total = $this->methodical_materials_teachers_model->count_all();
            
            //Налаштування (для чого навігація, ім'я для підстановки до base_url, всі, обмеження)
            $settings = $this->pagination_lib->get_settings('teachers_delete','',$total,$limit);
            
            //Застосовуємо налаштування
            $this->pagination->initialize($settings);            
        
            //Список методичних матеріалів, розбитий відповідно до pagination   
            $data['teachers_list'] = $this->methodical_materials_teachers_model->get_other_pagination_admin($limit,$start_from); 
            
            //Ссилки pagination
            $data['page_nav'] = $this->pagination->create_links(); 
            
            $name = 'methodical_materials_teachers/delete';    
            $this->display_lib->admin_page($data,$name);
        }
        //Якщо кнопка "Видалити" натиснута
        else
        {
            //але не вибраний методичний матеріал
            if ( ! isset($_POST['methodical_materials_teachers_id']))
            {
                $name='info_error';
                $data['info'] = 'Не вибраний методичний матеріал для видалення';
                $this->display_lib->admin_info_page($data,$name);        
            }
            //вибраний методичний матеріал для видалення
            else 
            {
                //Отримуємо ідентифікатор методичного матеріалу з масиву POST
                $methodical_materials_teachers_id = $this->input->post('methodical_materials_teachers_id');
                $data_del = $this->methodical_materials_teachers_model->get($methodical_materials_teachers_id);
                
                if (empty($data_del))
                {
                    $data['info'] = 'Методичний матеріал видалений';
                    $name='info_ok';
                    $this->display_lib->admin_info_page($data,$name);
                }
                else
                {
                    //Видалення методичного матеріалу з папки
                    $img_del = $data_del['url_material'];
                    unlink('./'.$img_del);
                    
                }
                
                //Видаляємо методичний матеріал з вибраним ідентифікатором
                $this->methodical_materials_teachers_model->delete($methodical_materials_teachers_id);           
                $name='info_ok';
                $data['info'] = 'Методичний матеріал видалений';
                $this->display_lib->admin_info_page($data,$name);
            }
        }
    }
}
?>