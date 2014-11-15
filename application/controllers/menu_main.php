<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Menu_main extends CI_Controller
{
   public function index()
    {
        redirect (base_url());
    }

    //Добавлення нового пункту меню
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
            $this->form_validation->set_rules($this->menu_main_model->add_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                $add_ok = $this->input->post('name_item_id');
                $add_mas = $this->menu_main_model->get_admin($add_ok);
                
                if (empty($add_mas['name_item_id']))
                {
                    //Викликаємо функцію добавлення нового пункту меню
                    $this->menu_main_model->add();
                    
                    $name = 'info_ok';
                    $data['info'] = 'Новий пункт головного меню добовлений';
                    $this->display_lib->admin_info_page($data,$name);
                }  
                else
                {
                    $name = 'info_error';
                    $data['info'] = 'Такий пункт головного меню вже існує';
                    $this->display_lib->admin_info_page($data,$name);
                }
            }
            else
            {
                $name = 'menu_main/add';
                //Передаємо пустий масив data так, як цього потребує функція admin_page 
                $this->display_lib->admin_page($data,$name);           
            }
        }
              
        //Якщо не натиснута кнопка "Додати", виводимо порожню форму
        else
        {                      
            $name = 'menu_main/add';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //Редагування (вивід списку пунктів меню для вибору)  
    public function edit_list()
    {
        $this->auth_lib->check_admin();
        
        //Масив з всіма пунктами меню для виводу списку
        
        $data = array('menu_main_list' => $this->menu_main_model->get_other_admin());
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        $name = 'menu_main/edit_list';
    
        $this->display_lib->admin_page($data,$name);
    }
    
    //Редагування (форма із значеннями, які беруться з бази)
    public function edit($name_item_id = '')
    {
        $this->auth_lib->check_admin();
        
        $this->load->helper('tinymce');
        $this->load->helper('radio');
        
        //Формуємо масив одного пункту меню (row_array) для відображення у формі редагування 
        $data=array();
        $data = $this->menu_main_model->get_admin($name_item_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
           
        //Якщо масив пустий
        if (empty($data['name_item_id']))
        {
            $name = 'info_error';
            $data['info'] = 'Такого пункту головного меню не існує';       
            $this->display_lib->admin_info_page($data,$name);               
        }
        else
        {
            $data['names_pub'] = $this->menu_main_model->get_publish_values($name_item_id);
            $name = 'menu_main/edit';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //Оновлення пункту меню в базі даних)
    public function update($name_item_id = '')
    {
        $this->auth_lib->check_admin();
        
        $this->load->helper('tinymce'); 
        
        $data=array();
        $data = $this->menu_main_model->get_admin($name_item_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //Якщо натиснута кнопка "Оновити"
        if (isset($_POST['update_button']))
        {
            $this->form_validation->set_rules($this->menu_main_model->update_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                //Оновляємо пункт меню
                $this->menu_main_model->update($name_item_id);
                
                $name='info_ok';
                $data['info'] = 'Пункт головного меню оновлений';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                //Формуємо масив з даними пункту меню для підстановки в поля форми (ті, що не пройшли валідацію, беруться з бази, а ті, що пройшли - з масиву POST)
                $data = $this->menu_main_model->get_admin($name_item_id);
                $data['menu_top'] = $this->menu_top_model->get_other();
                $data['menu_main'] = $this->menu_main_model->get_other();
                $data['img_footer'] = $this->img_footer_model->get_other();
               
                $name = 'menu_main/edit';
                $this->display_lib->admin_page($data,$name);
            }
        }
        //Не натиснута кнопка "Оновити"
        else
        {
            $name='info_error';
            $data['info'] = 'Пункт головного меню не був оновлений, томущо Ви не натиснули кнопку "Оновити"';
            $this->display_lib->admin_info_page($data,$name);
        }
    }
    
    //Видалення пункту меню
    public function delete()
    {
        $this->auth_lib->check_admin();
        
        $data=array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //Якщо не натиснута кнопка "Видалити"
        if ( ! isset($_POST['delete_button']))
        {
            //Масив з всіма пунктами меню
            $data['menu_main_list'] = $this->menu_main_model->get_other_admin();
            $name = 'menu_main/delete';
    
            $this->display_lib->admin_page($data,$name);
        }
        
        //Якщо натиснута кнопка "Видалити"
        else
        {
            //але не вибраний пункт меню
            if ( ! isset($_POST['name_item_id']))
            {
                $name='info_error';
                $data['info'] = 'Не вибраний пункт головного меню для видалення';
                $this->display_lib->admin_info_page($data,$name);                      
            }
    
            //і вибраний пункт головного меню для видалення
            else 
            {
                //Отримуємо ідентифікатор пункту головного меню з масиву POST
                $name_item_id = $this->input->post('name_item_id');
                
                //Видаляємо пункт головного меню з вибраним ідентифікатором
                $this->menu_main_model->delete($name_item_id);                         
                
                $name='info_ok';
                $data['info'] = 'Пункт головного меню видалений';                  
                $this->display_lib->admin_info_page($data,$name);            
            }
        }
    }
    

}
?>