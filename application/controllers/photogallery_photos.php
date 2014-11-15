<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Photogallery_photos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('photogallery_sections_model');
        $this->load->model('photogallery_photos_model');
    }
    
    public function index()
    {
        redirect (base_url());
    }

//Добавлення нової фотографії
    public function add()
    {
        $this->auth_lib->check_admin();
        
        $this->load->helper('tinymce');
        
        $data = array();
        
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        $data['all_photogallery_sections'] = $this->photogallery_sections_model->get_other();
            
        $this->load->library('upload');
        $this->load->library('upload_lib');
        $this->load->library('image_lib');
        $this->load->library('image_small_lib');
    
        //Налаштування 
        $settings = $this->upload_lib->get_settings('photogallery');
                   
        //Застосовуємо налаштування
        $this->upload->initialize($settings);
            
        //Якщо натиснута кнопка "Додати"  
        if (isset($_POST['add_button']))
        {
            
            
            $this->form_validation->set_rules($this->photogallery_photos_model->add_rules);
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
                        $width =100;
                        $height =75;
                    }
                    else
                    {
                        $width =75;
                        $height =100;
                        
                    }
                    $settings = $this->image_small_lib->get_settings('photogallery',$url_small, $width, $height);
                
                    //Застосовуємо налаштування
                    $this->image_lib->initialize($settings);
                    $this->image_lib->resize();
                
                    //Додаємо нову фотографію
                    $this->photogallery_photos_model->add_photo('photogallery',$img_name);
                    
                    if ( ! $this->image_lib->resize())
                    {
                        $name = 'info_error';
                        $data['info'] = $this->image_lib->display_errors();
                        $this->display_lib->admin_info_page($data,$name);  
                    }
                    else
                    {
                        $data['menu_top'] = $this->menu_top_model->get_other();
                        $data['menu_main'] = $this->menu_main_model->get_other();
                        $data['img_footer'] = $this->img_footer_model->get_other();
                        $add_button = $this->input->post('add_button');
                        unset($add_button);
                        $name = 'info_ok';
                        $data['info'] = 'Фотографія добавлена';
                        $this->display_lib->admin_info_page($data,$name);
                    }
                }
           }
           else
           {
           $name = 'photogallery_photos/add';
           //Передаємо пустий масив data так, як цього потребує функція admin_page 
           $this->display_lib->admin_page($data,$name); 			
           }
        }
          
        //Якщо не натиснута кнопка "Додати", виводимо порожню форму
        else
        {
            $name = 'photogallery_photos/add';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //Редагування фотографій (вивід списку фотографій для вибору)  
    public function edit_list($start_from = 0)
    {
        $this->auth_lib->check_admin();
        
        $data = array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        $this->load->library('pagination');
        $this->load->library('pagination_lib');
        
        //Задаємо обмеження числа фотографій на сторінку
        $limit = $this->config->item('admin_per_page');
        
        //Рахуємо загальну кількість фотографій
        $total = $this->photogallery_photos_model->count_all(); 
        
        //Налаштування (для чого навігація, ім'я для підстановки до base_url, всі, обмеження)
        $settings = $this->pagination_lib->get_settings('photogallery_edit_list','',$total,$limit);
        
        //Застосовуємо налаштування
        $this->pagination->initialize($settings);      
        
        //Список фотографій
        $data['photogallery_photos_list'] = $this->photogallery_photos_model->get_other_pagination_admin($limit,$start_from); 
        
        //Ссилки pagination   
        $data['page_nav'] = $this->pagination->create_links();
        
        $name = 'photogallery_photos/edit_list';
        $this->display_lib->admin_page($data,$name);
    }
    
    //Редагування (форма із значеннями, які беруться з бази)
    public function edit($photogallery_photo_id = '')
    {
        $this->auth_lib->check_admin();
        
        $this->load->helper('tinymce');
        $this->load->helper('radio');
        
        //Формуємо масив однієї фотографії (row_array) для відображення у формі редагування 
        $data=array();
        $data = $this->photogallery_photos_model->get_admin($photogallery_photo_id);
        $data['all_photogallery_sections'] = $this->photogallery_sections_model->get_other();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
           
        //Якщо масив пустий
        if (empty($data['photogallery_photo_id']))
        {
            $name = 'info_error';
            $data['info'] = 'Такої фотографії не існує';       
            $this->display_lib->admin_info_page($data,$name);               
        }
        else
        {
            $data['names_pub'] = $this->photogallery_photos_model->get_publish_values($photogallery_photo_id);
            $data['names_sel'] = $this->photogallery_photos_model->get_section_values($photogallery_photo_id);
            $name = 'photogallery_photos/edit';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //Оновлення фотографії в базі даних)
    public function update($photogallery_photo_id = '')
    {
        $this->auth_lib->check_admin();
        
        $data=array();
        $data = $this->photogallery_photos_model->get_admin($photogallery_photo_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //Якщо натиснута кнопка "Оновити"
        if (isset($_POST['update_button']))
        {
            $this->form_validation->set_rules($this->photogallery_photos_model->update_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                //Оновляємо фотографію
                $this->photogallery_photos_model->update($photogallery_photo_id);
                
                $name='info_ok';
                $data['info'] = 'Фотографія оновлена';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                //Формуємо масив з даними фотографії для підстановки в поля форми (ті, що не пройшли валідацію, беруться з бази, а ті, що пройшли - з масиву POST)
                $data = $this->photogallery_photos_model->get_admin($photogallery_photo_id);
                $data['menu_top'] = $this->menu_top_model->get_other();
                $data['menu_main'] = $this->menu_main_model->get_other();
                $data['img_footer'] = $this->img_footer_model->get_other();
               
                $name = 'photogallery_photos/edit';
                $this->display_lib->admin_page($data,$name);
            }
        }
        //Не натиснута кнопка "Оновити"
        else
        {
            $name='info_error';
            $data['info'] = 'Фотографія не була оновлена, томущо Ви не натиснули кнопку "Оновити"';
            $this->display_lib->admin_info_page($data,$name);
        }
    }
    
    //Видалення фотографії
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
          
            //Рахуємо загальну кількість фотографій
            $total = $this->photogallery_photos_model->count_all();        
          
            //Налаштування (для чого навігація, ім'я для підстановки до base_url, всі, обмеження)
            $settings = $this->pagination_lib->get_settings('photogallery_delete','',$total,$limit);
                    
            //Застосовуємо налаштування
            $this->pagination->initialize($settings);            
            
            //Список фотографій, розбитий відповідно до pagination   
            $data['photogallery_list'] = $this->photogallery_photos_model->get_other_pagination_admin($limit,$start_from); 
            
            //Ссилки pagination
            $data['page_nav'] = $this->pagination->create_links(); 
            $name = 'photogallery_photos/delete';    
            
            $this->display_lib->admin_page($data,$name);
        }
        
        //Якщо кнопка "Видалити" натиснута
        else
        {
            //але не вибрана фотографія
            if ( ! isset($_POST['photogallery_photo_id']))
            {
                $data['info'] = 'Не вибрана фотографія для видалення';
                $name='info_error';
                $this->display_lib->admin_info_page($data,$name);        
            }
    
            //вибрана фотографія для видалення
            else 
            {  
                //Отримуємо ідентифікатор фотографії з масивау POST
                $photogallery_photo_id = $this->input->post('photogallery_photo_id');
                $data_del = $this->photogallery_photos_model->get($photogallery_photo_id);
                if (empty($data_del))
                {
                    $data['info'] = 'Фотографія видалена';
                    $name='info_ok';
                    $this->display_lib->admin_info_page($data,$name);
                }
                else
                {
                    //Видалення фотографії з папки
                    $img_del_small = $data_del['url_small_img'];
                    $img_del_big = $data_del['url_big_img'];
                    unlink('./'.$img_del_small);
                    unlink('./'.$img_del_big);
                }
                //Видаляємо фотографію
                $this->photogallery_photos_model->delete($photogallery_photo_id);           
                $data['info'] = 'Фотографія видалена';
                $name='info_ok';
                $this->display_lib->admin_info_page($data,$name);
            }
        }
    }
}
?>