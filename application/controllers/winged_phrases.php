<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Winged_phrases extends CI_Controller
{
    public function index()
    {
       redirect (base_url());
    }
    
    //Додавання крилатої фрази
    public function add()
    {
        $this->auth_lib->check_admin();
        
        $this->load->helper('tinymce');
        
        $data=array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //Якщо натиснута кнопка "Додати"  
        if (isset($_POST['add_button']))      
        {
            $this->form_validation->set_rules($this->winged_phrases_model->add_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                //Викликаємо функцію добавлення крилатої фрази
                $this->winged_phrases_model->add();
                $name = 'info_ok';
                $data['info'] = 'Крилата фраза добавлена';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                $name = 'winged_phrases/add';
                //Передаємо пустий масив data так, як цього потребує функція admin_page 
                $this->display_lib->admin_page($data,$name);           
            }
        }
              
        //Якщо не натиснута кнопка "Додати", виводимо порожню форму
        else
        {                      
            $name = 'winged_phrases/add';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //Редагування крилатої фрази (вивід списку крилатих фраз для вибору)  
    public function edit_list($start_from = 0)
    {
        $this->auth_lib->check_admin();
        
        $data = array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        $this->load->library('pagination');
        $this->load->library('pagination_lib');
        
        //Задаємо обмеження числа крилатих фраз на сторінку
        $limit = $this->config->item('admin_per_page');
        
        //Рахуємо загальну кількість крилатих фраз
        $total = $this->winged_phrases_model->count_all(); 
        
        //Налаштування (для чого навігація, ім'я для підстановки до base_url, всі, обмеження)
        $settings = $this->pagination_lib->get_settings('winged_phrases_edit_list','',$total,$limit);
        
        //Застосовуємо налаштування
        $this->pagination->initialize($settings);      
        
        //Список крилатих фраз
        $data['winged_phrases_list'] = $this->winged_phrases_model->get_other_pagination_admin($limit,$start_from); 
        
        //Ссилки pagination   
        $data['page_nav'] = $this->pagination->create_links();
        
        $name = 'winged_phrases/edit_list';
        $this->display_lib->admin_page($data,$name);
    }
    
    //Редагування крилатої фрази
    public function edit($winged_phrases_id = '')
    {
        $this->auth_lib->check_admin();
        
        $this->load->helper('tinymce');
        $this->load->helper('radio');    
        
        //Формуємо масив одної крилатої фрази для відображення у формі редагування
        $data = array();
        
        $data = $this->winged_phrases_model->get_admin($winged_phrases_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //Якщо масив порожній
        if (empty($data['winged_phrases_id']))
        {
            $name='info_error';
            $data['info'] = 'Такої крилатої фрази не існує';
            $this->display_lib->admin_info_page($data,$name);
        }
        else
        {   
            $data['names_pub'] = $this->winged_phrases_model->get_publish_values($winged_phrases_id);
            $name = 'winged_phrases/edit';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //Оновлення крилатої фрази
    public function update($winged_phrases_id = '')
    {
        $this->auth_lib->check_admin(); 
        
        $this->load->helper('radio');
        $this->load->helper('tinymce');
        
        $data = array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //Якщо натиснута кнопка "Оновити"
        if (isset($_POST['update_button']))
        {
            $this->form_validation->set_rules($this->winged_phrases_model->update_rules);
            if ($this->form_validation->run() == TRUE)
            {
                //Оновлюємо крилату фразу
                $this->winged_phrases_model->update($winged_phrases_id);
                
                $name='info_ok';
                $data['info'] = 'Крилата фраза оновлена';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                //формуємо масив з даними про крилату фразу для підстановки в поля форми
                $data = $this->winged_phrases_model->get_admin($winged_phrases_id);
                $data['menu_top'] = $this->menu_top_model->get_other();
                $data['menu_main'] = $this->menu_main_model->get_other();
                $data['img_footer'] = $this->img_footer_model->get_other();
                $data['names_pub'] = $this->winged_phrases_model->get_publish_values($winged_phrases_id);                             
                
                $name = 'winged_phrases/edit';
                $this->display_lib->admin_page($data,$name);
            }
        }
        //Не натиснута кнопка "Оновити"
        else
        {
            $name='info_error';
            $data['info'] = 'Крилата фраза не була оновлена, томущо Ви не натиснули кнопки "Оновити"';
            $this->display_lib->admin_info_page($data,$name);
        }
    }
    
    //Видалення крилатої фрази
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
            //Задаємо обмеження числа крилатих фраз на сторінку 
            $limit = $this->config->item('admin_per_page');
            
            //Рахуємо загальну кількість крилатих фраз
            $total = $this->winged_phrases_model->count_all();
            
            //Налаштування (для чого навігація, ім'я для підстановки до base_url, всі, обмеження)
            $settings = $this->pagination_lib->get_settings('winged_phrases_delete','',$total,$limit);
            
            //Застосовуємо налаштування
            $this->pagination->initialize($settings);            
        
            //Список крилатих фраз, розбитий відповідно до pagination   
            $data['winged_phrases_list'] = $this->winged_phrases_model->get_other_pagination_admin($limit,$start_from); 
            
            //Ссилки pagination
            $data['page_nav'] = $this->pagination->create_links(); 
            
            $name = 'winged_phrases/delete';    
            $this->display_lib->admin_page($data,$name);
        }
        //Якщо кнопка "Видалити" натиснута
        else
        {
            //але не вибрана крилата фраза
            if ( ! isset($_POST['winged_phrases_id']))
            {
                $name='info_error';
                $data['info'] = 'Не вибрана крилата фраза для видалення';
                $this->display_lib->admin_info_page($data,$name);        
            }
            //вибрана крилата фраза
            else 
            {
                //Отримуємо ідентифікатор крилатої фрази з масиву POST
                $winged_phrases_id = $this->input->post('winged_phrases_id');
                
                //Видаляємо крилату фразу з вибраним ідентифікатором
                $this->winged_phrases_model->delete($winged_phrases_id);           
                
                $name='info_ok';
                $data['info'] = 'Крилата фраза видалена';
                $this->display_lib->admin_info_page($data,$name);
            }
        }
    }
}
?>