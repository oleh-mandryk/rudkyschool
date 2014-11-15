<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class I_wonder extends CI_Controller
{
    public function index()
    {
       redirect (base_url());
    }
    
    //Додавання цікаво знати
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
            $this->form_validation->set_rules($this->i_wonder_model->add_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                //Викликаємо функцію добавлення цікаво знати
                $this->i_wonder_model->add();
                $name = 'info_ok';
                $data['info'] = 'Цікаво знати добавлено';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                $name = 'i_wonder/add';
                //Передаємо пустий масив data так, як цього потребує функція admin_page 
                $this->display_lib->admin_page($data,$name);           
            }
        }
              
        //Якщо не натиснута кнопка "Додати", виводимо порожню форму
        else
        {                      
            $name = 'i_wonder/add';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //Редагування цікаво знати (вивід списку цікаво знати для вибору)  
    public function edit_list($start_from = 0)
    {
        $this->auth_lib->check_admin();
        
        $data = array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        $this->load->library('pagination');
        $this->load->library('pagination_lib');
        
        //Задаємо обмеження числа цікаво знати на сторінку
        $limit = $this->config->item('admin_per_page');
        
        //Рахуємо загальну кількість цікаво знати
        $total = $this->i_wonder_model->count_all(); 
        
        //Налаштування (для чого навігація, ім'я для підстановки до base_url, всі, обмеження)
        $settings = $this->pagination_lib->get_settings('i_wonder_edit_list','',$total,$limit);
        
        //Застосовуємо налаштування
        $this->pagination->initialize($settings);      
        
        //Список цікаво знати
        $data['i_wonder_list'] = $this->i_wonder_model->get_other_pagination_admin($limit,$start_from); 
        
        //Ссилки pagination   
        $data['page_nav'] = $this->pagination->create_links();
        
        $name = 'i_wonder/edit_list';
        $this->display_lib->admin_page($data,$name);
    }
    
    //Редагування цікаво знати
    public function edit($i_wonder_id = '')
    {
        $this->auth_lib->check_admin();
        
        $this->load->helper('tinymce');
        $this->load->helper('radio');    
        
        //Формуємо масив одної цікаво знати для відображення у формі редагування
        $data = array();
        
        $data = $this->i_wonder_model->get_admin($i_wonder_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //Якщо масив порожній
        if (empty($data['i_wonder_id']))
        {
            $name='info_error';
            $data['info'] = 'Такого цікаво знати не існує';
            $this->display_lib->admin_info_page($data,$name);
        }
        else
        {   
            $data['names_pub'] = $this->i_wonder_model->get_publish_values($i_wonder_id);
            $name = 'i_wonder/edit';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //Оновлення цікаво знати
    public function update($i_wonder_id = '')
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
            $this->form_validation->set_rules($this->i_wonder_model->update_rules);
            if ($this->form_validation->run() == TRUE)
            {
                //Оновлюємо цікаво знати
                $this->i_wonder_model->update($i_wonder_id);
                
                $name='info_ok';
                $data['info'] = 'Цікаво знати оновлено';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                //формуємо масив з даними про цікаво знати для підстановки в поля форми
                $data = $this->i_wonder_model->get_admin($i_wonder_id);
                $data['menu_top'] = $this->menu_top_model->get_other();
                $data['menu_main'] = $this->menu_main_model->get_other();
                $data['img_footer'] = $this->img_footer_model->get_other();
                $data['names_pub'] = $this->i_wonder_model->get_publish_values($i_wonder_id);                             
                
                $name = 'i_wonder/edit';
                $this->display_lib->admin_page($data,$name);
            }
        }
        //Не натиснута кнопка "Оновити"
        else
        {
            $name='info_error';
            $data['info'] = 'Цікаво знати не було оновлено, томущо Ви не натиснули кнопки "Оновити"';
            $this->display_lib->admin_info_page($data,$name);
        }
    }
    
    //Видалення цікаво знати
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
            //Задаємо обмеження числа цікаво знати на сторінку 
            $limit = $this->config->item('admin_per_page');
            
            //Рахуємо загальну кількість цікаво знати
            $total = $this->i_wonder_model->count_all();
            
            //Налаштування (для чого навігація, ім'я для підстановки до base_url, всі, обмеження)
            $settings = $this->pagination_lib->get_settings('i_wonder_delete','',$total,$limit);
            
            //Застосовуємо налаштування
            $this->pagination->initialize($settings);            
        
            //Список цікаво знати, розбитий відповідно до pagination   
            $data['i_wonder_list'] = $this->i_wonder_model->get_other_pagination_admin($limit,$start_from); 
            
            //Ссилки pagination
            $data['page_nav'] = $this->pagination->create_links(); 
            
            $name = 'i_wonder/delete';    
            $this->display_lib->admin_page($data,$name);
        }
        //Якщо кнопка "Видалити" натиснута
        else
        {
            //але не вибрано цікаво знати
            if ( ! isset($_POST['i_wonder_id']))
            {
                $name='info_error';
                $data['info'] = 'Не вибрано цікаво знати для видалення';
                $this->display_lib->admin_info_page($data,$name);        
            }
            //вибрано цікаво знати
            else 
            {
                //Отримуємо ідентифікатор цікаво знати з масиву POST
                $i_wonder_id = $this->input->post('i_wonder_id');
                
                //Видаляємо крилату фразу з вибраним ідентифікатором
                $this->i_wonder_model->delete($i_wonder_id);           
                
                $name='info_ok';
                $data['info'] = 'Цікаво знати видалено';
                $this->display_lib->admin_info_page($data,$name);
            }
        }
    }
}
?>