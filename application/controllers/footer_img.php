<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Footer_img extends CI_Controller
{
    public function index()
    {
        redirect (base_url());
    }

    //Добавлення нового зображення у футер
    public function add()
    {
        $this->auth_lib->check_admin();
        
        $data = array();
        
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
                          
        $this->load->library('upload');
        $this->load->library('upload_lib');
        $this->load->library('image_lib');
        $this->load->library('image_small_lib');
    
        //Налаштування 
        $settings = $this->upload_lib->get_settings('img_footer');
                   
        //Застосовуємо налаштування
        $this->upload->initialize($settings);
            
        //Якщо натиснута кнопка "Додати"  
        if (isset($_POST['add_button']))
        {
            $this->form_validation->set_rules($this->img_footer_model->add_rules);
            if ($this->form_validation->run() == TRUE)
            {
                if ( ! $this->upload->do_upload())
                {
                    $name = 'info_error';
                    $data['info'] = $this->upload->display_errors();
                    $this->display_lib->admin_info_page($data,$name );
                }
                else
                {
        			$data = array('upload_data' => $this->upload->data());
        			
                    $url_small = $data ['upload_data']['full_path'];
                    $width = $data ['upload_data']['image_width'];
                    $height = $data ['upload_data']['image_height'];
                    $img_name = $data ['upload_data']['file_name'];
                    
                    if ($width>$height)
                    {
                        $width =70;
                        $height =31;
                    }
                    else
                    {
                        $width =31;
                        $height =70;
                        
                    }
                    $settings = $this->image_small_lib->get_settings('img_footer',$url_small, $width, $height);
                
                    //Застосовуємо налаштування
                    $this->image_lib->initialize($settings);
                    $this->image_lib->resize();
                
                    //Додаємо нове зображення для футера
                    $this->img_footer_model->add_photo('img_footer',$img_name);
                    
                    if ( ! $this->image_lib->resize())
                    {
                        $name = 'info_error';
                        $data['info'] = $this->image_lib->display_errors();
                        $this->display_lib->admin_info_page($data,$name);  
                    }
                    else
                    {
                        unlink($url_small);
                        $data['menu_top'] = $this->menu_top_model->get_other();
                        $data['menu_main'] = $this->menu_main_model->get_other();
                        $data['img_footer'] = $this->img_footer_model->get_other();
                        
                        $name = 'info_ok';
                        $data['info'] = 'Зображення для футера добавлено';
                        $this->display_lib->admin_info_page($data,$name);
                    }
                }
           }
           else
           {
               $name = 'footer_img/add';
               //Передаємо пустий масив data так, як цього потребує функція admin_page 
               $this->display_lib->admin_page($data,$name); 			
           }
        }
          
        //Якщо не натиснута кнопка "Додати", виводимо порожню форму
        else
        {
            $name = 'footer_img/add';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //Редагування зображень для футера (вивід списку зображень для футера для вибору)  
    public function edit_list($start_from = 0)
    {
        $this->auth_lib->check_admin();
        
        $data = array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        $this->load->library('pagination');
        $this->load->library('pagination_lib');
        
        //Задаємо обмеження числа зображень для футера на сторінку
        $limit = $this->config->item('admin_per_page');
        
        //Рахуємо загальну кількість зображень для футера
        $total = $this->img_footer_model->count_all(); 
        
        //Налаштування (для чого навігація, ім'я для підстановки до base_url, всі, обмеження)
        $settings = $this->pagination_lib->get_settings('footer_edit_list','',$total,$limit);
        
        //Застосовуємо налаштування
        $this->pagination->initialize($settings);      
        
        //Список зображень для футера
        $data['footer_list'] = $this->img_footer_model->get_other_pagination_admin($limit,$start_from); 
        
        //Ссилки pagination   
        $data['page_nav'] = $this->pagination->create_links();
        
        $name = 'footer_img/edit_list';
        $this->display_lib->admin_page($data,$name);
    }
    
    //Редагування (форма із значеннями, які беруться з бази)
    public function edit($img_footer_id = '')
    {
        $this->auth_lib->check_admin();
        
        $this->load->helper('radio');
        
        //Формуємо масив одного зображення (row_array) для відображення у формі редагування 
        $data=array();
        $data = $this->img_footer_model->get_admin($img_footer_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
           
        //Якщо масив пустий
        if (empty($data['img_footer_id']))
        {
            $name = 'info_error';
            $data['info'] = 'Такого зображення для футера не існує';       
            $this->display_lib->admin_info_page($data,$name);               
        }
        else
        {
            $data['names_pub'] = $this->img_footer_model->get_publish_values($img_footer_id);
            $name = 'footer_img/edit';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //Оновлення зображення для футера в базі даних)
    public function update($img_footer_id = '')
    {
        $this->auth_lib->check_admin();
        
        $data=array();
        $data = $this->img_footer_model->get_admin($img_footer_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //Якщо натиснута кнопка "Оновити"
        if (isset($_POST['update_button']))
        {
            $this->form_validation->set_rules($this->img_footer_model->update_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                //Оновляємо зображення для футера
                $this->img_footer_model->update($img_footer_id);
                
                $name='info_ok';
                $data['info'] = 'Зображення для футера оновлене';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                //Формуємо масив з даними зображення для футера для підстановки в поля форми (ті, що не пройшли валідацію, беруться з бази, а ті, що пройшли - з масиву POST)
                $data = $this->img_footer_model->get_admin($img_footer_id);
                $data['menu_top'] = $this->menu_top_model->get_other();
                $data['menu_main'] = $this->menu_main_model->get_other();
                $data['img_footer'] = $this->img_footer_model->get_other();
               
                $name = 'footer_img/edit';
                $this->display_lib->admin_page($data,$name);
            }
        }
        //Не натиснута кнопка "Оновити"
        else
        {
            $name='info_error';
            $data['info'] = 'Зображення для футера не було оновлене, томущо Ви не натиснули кнопку "Оновити"';
            $this->display_lib->admin_info_page($data,$name);
        }
    }
    
    //Видалення зображення для футера
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
            //Задаємо обмеження числа зображень для футера на сторінку  
            $limit = $this->config->item('admin_per_page');
          
            //Рахуємо загальну кількість зображень для футера
            $total = $this->img_footer_model->count_all();        
          
            //Налаштування (для чого навігація, ім'я для підстановки до base_url, всі, обмеження)
            $settings = $this->pagination_lib->get_settings('footer_delete','',$total,$limit);
                    
            //Застосовуємо налаштування
            $this->pagination->initialize($settings);            
            
            //Список зображень для футера, розбитий відповідно до pagination   
            $data['footer_list'] = $this->img_footer_model->get_other_pagination_admin($limit,$start_from); 
            
            //Ссилки pagination
            $data['page_nav'] = $this->pagination->create_links(); 
            $name = 'footer_img/delete';    
            
            $this->display_lib->admin_page($data,$name);
        }
        
        //Якщо кнопка "Видалити" натиснута
        else
        {
            //але не вибране зображення футера
            if ( ! isset($_POST['img_footer_id']))
            {
                $data['info'] = 'Не вибране зображення футера для видалення';
                $name='info_error';
                $this->display_lib->admin_info_page($data,$name);        
            }
    
            //вибране зображення футера для видалення
            else 
            {  
                //Отримуємо ідентифікатор зображення з масивау POST
                $img_footer_id = $this->input->post('img_footer_id');
                $data_del = $this->img_footer_model->get($img_footer_id);
                if (empty($data_del))
                {
                    $data['info'] = 'Зображення для футера видалене';
                    $name='info_ok';
                    $this->display_lib->admin_info_page($data,$name);
                }
                else
                {
                    //Видалення зображення для футера з папки
                    $img_del = $data_del['img_url'];
                    unlink('./'.$img_del);
                    
                }
                //Видаляємо зображення для футера
                $this->img_footer_model->delete($img_footer_id);           
                $data['info'] = 'Зображення для футера видалене';
                $name='info_ok';
                $this->display_lib->admin_info_page($data,$name);
            }
        }
    }
}
?>