<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Schedule extends CI_Controller
{
    public function index()
    {
       redirect (base_url());
    }
    
    public function schedule_pupils()
    {
        $this->load->helper('radio');
        $this->load->model('schedule_model');
        $this->load->model('schedule_date_model');
                
        //формуємо масив для передавання у вид;
        $data=array();
        
        //масив для заголовка розкладу
        $data['schedule_date'] = $this->schedule_date_model->get($date_id=1);
        
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
        
        if (isset($_POST['schedule_pupils']))
        {
            $class_ok = $this->input->post('schedule_pupils');
            $data['schedule_monday'] = $this->schedule_model->lessons_monday($class_ok);
            $data['schedule_tuesday'] = $this->schedule_model->lessons_tuesday($class_ok);
            $data['schedule_wednesday'] = $this->schedule_model->lessons_wednesday($class_ok);
            $data['schedule_thursday'] = $this->schedule_model->lessons_thursday($class_ok);
            $data['schedule_friday'] = $this->schedule_model->lessons_friday($class_ok);
            $data['groups_all'] = $this->schedule_model->get_class();
            $data['names_sel'] = $this->input->post('schedule_pupils');
            $data['title_info']='Розклад занять';
            $name = 'schedule/schedule_pupils';
            $this->display_lib->user_info_page($data,$name);
        }
        else
        {
            $data['groups_all'] = $this->schedule_model->get_class();
            $data['names_sel']='';
            $data['title_info']='Розклад занять';
            $name = 'schedule/schedule_pupils';
            $this->display_lib->user_info_page($data,$name);
        }
    }
    
    public function schedule_teachers()
    {
        $this->load->helper('radio');
        $this->load->model('schedule_model');
        $this->load->model('schedule_date_model');
                
        //формуємо масив для передавання у вид;
        $data=array();
        
        //масив для заголовка розкладу
        $data['schedule_date'] = $this->schedule_date_model->get($date_id=1);
        
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
        
        if (isset($_POST['schedule_teachers']))
        {
            $teacher_ok = $this->input->post('schedule_teachers');
            $data['schedule_monday'] = $this->schedule_model->teachers_lessons_monday($teacher_ok);
            $data['schedule_tuesday'] = $this->schedule_model->teachers_lessons_tuesday($teacher_ok);
            $data['schedule_wednesday'] = $this->schedule_model->teachers_lessons_wednesday($teacher_ok);
            $data['schedule_thursday'] = $this->schedule_model->teachers_lessons_thursday($teacher_ok);
            $data['schedule_friday'] = $this->schedule_model->teachers_lessons_friday($teacher_ok);
            $data['teachers_all'] = $this->schedule_model->get_teachers();
            $data['names_sel'] = $this->input->post('schedule_teachers');
            $data['title_info']='Розклад занять';
            $name = 'schedule/schedule_teachers';
            $this->display_lib->user_info_page($data,$name);
        }
        else
        {
            $data['teachers_all'] = $this->schedule_model->get_teachers();
            $data['names_sel']='';
            $data['title_info']='Розклад занять';
            $name = 'schedule/schedule_teachers';
            $this->display_lib->user_info_page($data,$name);
        }
    }
    
    //Редагування (вивід списку для вибору)  
    public function edit_list_schedule_date()
    {
        $this->auth_lib->check_admin();
        $this->load->model('schedule_date_model');
        //Масив з всіма сторінками для виводу списку
        
        $data = array('schedule_date_list' => $this->schedule_date_model->get_other_admin());
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        $name = 'schedule_date/edit_list';
    
        $this->display_lib->admin_page($data,$name);
    }
    
    //Редагування (форма із значеннями, які беруться з бази)
    public function edit_schedule_date($date_id = '')
    {
        $this->auth_lib->check_admin();
        $this->load->model('schedule_date_model');
        
        //Формуємо масив (row_array) для відображення у формі редагування 
        $data=array();
        $data = $this->schedule_date_model->get_admin($date_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
           
        //Якщо масив пустий
        if (empty($data['date_id']))
        {
            $name = 'info_error';
            $data['info'] = 'Такої періоду навчального року не існує';       
            $this->display_lib->admin_info_page($data,$name);               
        }
        else
        {
            $name = 'schedule_date/edit';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //Оновлення періоду навчального року в базі даних)
    public function update_schedule_date($date_id = '')
    {
        $this->auth_lib->check_admin();
        $this->load->model('schedule_date_model');
        
        $data=array();
        $data = $this->schedule_date_model->get_admin($date_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //Якщо натиснута кнопка "Оновити"
        if (isset($_POST['update_button']))
        {
            $this->form_validation->set_rules($this->schedule_date_model->update_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                //Оновляємо період навчального року
                $this->schedule_date_model->update($date_id);
                
                $name='info_ok';
                $data['info'] = 'Період навчального року оновлений';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                //Формуємо масив з даними для підстановки в поля форми (ті, що не пройшли валідацію, беруться з бази, а ті, що пройшли - з масиву POST)
                $data = $this->schedule_date_model->get_admin($date_id);
                $data['menu_top'] = $this->menu_top_model->get_other();
                $data['menu_main'] = $this->menu_main_model->get_other();
                $data['img_footer'] = $this->img_footer_model->get_other();
               
                $name = 'schedule_date/edit';
                $this->display_lib->admin_page($data,$name);
            }
        }
        //Не натиснута кнопка "Оновити"
        else
        {
            $name='info_error';
            $data['info'] = 'Період навчального року не був оновлений, томущо Ви не натиснули кнопку "Оновити"';
            $this->display_lib->admin_info_page($data,$name);
        }
    }
    
    //Додавання уроку
    public function add_schedule()
    {
        $this->auth_lib->check_admin();
        $this->load->model('schedule_model');
        
        $data=array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //Якщо натиснута кнопка "Додати"  
        if (isset($_POST['add_button']))      
        {
            $this->form_validation->set_rules($this->schedule_model->add_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                //Викликаємо функцію добавлення уроку
                $this->schedule_model->add();
                $name = 'info_ok';
                $data['info'] = 'Урок добавлений';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                $name = 'schedule/add';
                //Передаємо пустий масив data так, як цього потребує функція admin_page 
                $this->display_lib->admin_page($data,$name);           
            }
        }
              
        //Якщо не натиснута кнопка "Додати", виводимо порожню форму
        else
        {                      
            $name = 'schedule/add';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //Редагування уроку (вивід списку уроків для вибору)  
    public function edit_list_schedule($start_from = 0)
    {
        $this->auth_lib->check_admin();
        $this->load->model('schedule_model');
        
        $data = array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        $this->load->library('pagination');
        $this->load->library('pagination_lib');
        
        //Задаємо обмеження числа уроків на сторінку
        $limit = $this->config->item('admin_per_page');
        
        //Рахуємо загальну кількість уроків
        $total = $this->schedule_model->count_all(); 
        
        //Налаштування (для чого навігація, ім'я для підстановки до base_url, всі, обмеження)
        $settings = $this->pagination_lib->get_settings('schedule_edit_list','',$total,$limit);
        
        //Застосовуємо налаштування
        $this->pagination->initialize($settings);      
        
        //Список уроків
        $data['schedule_list'] = $this->schedule_model->get_other_pagination_admin($limit,$start_from); 
        
        //Ссилки pagination   
        $data['page_nav'] = $this->pagination->create_links();
        
        $name = 'schedule/edit_list';
        $this->display_lib->admin_page($data,$name);
    }
    
    //Редагування уроку
    public function edit_schedule($schedule_id = '')
    {
        $this->auth_lib->check_admin();
        
        $this->load->model('schedule_model');
        $this->load->helper('radio');    
                
        //Формуємо масив одної крилатої фрази для відображення у формі редагування
        $data = array();
        
        $data = $this->schedule_model->get_admin($schedule_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //Якщо масив порожній
        if (empty($data['schedule_id']))
        {
            $name='info_error';
            $data['info'] = 'Такого уроку не існує';
            $this->display_lib->admin_info_page($data,$name);
        }
        else
        {   
            $data['names_pub'] = $this->schedule_model->get_publish_values($schedule_id);
            $data['names_sel'] = $this->schedule_model->get_day_values($schedule_id);
            $name = 'schedule/edit';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //Оновлення уроку
    public function update_schedule($schedule_id = '')
    {
        $this->auth_lib->check_admin(); 
        
        $this->load->model('schedule_model');
        $this->load->helper('radio');
                
        $data = array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //Якщо натиснута кнопка "Оновити"
        if (isset($_POST['update_button']))
        {
            $this->form_validation->set_rules($this->schedule_model->update_rules);
            if ($this->form_validation->run() == TRUE)
            {
                //Оновлюємо урок
                $this->schedule_model->update($schedule_id);
                
                $name='info_ok';
                $data['info'] = 'Урок оновлений';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                //формуємо масив з даними про урок для підстановки в поля форми
                $data = $this->schedule_model->get_admin($schedule_id);
                $data['menu_top'] = $this->menu_top_model->get_other();
                $data['menu_main'] = $this->menu_main_model->get_other();
                $data['img_footer'] = $this->img_footer_model->get_other();
                $data['names_pub'] = $this->schedule_model->get_publish_values($schedule_id);                             
                
                $name = 'schedule/edit';
                $this->display_lib->admin_page($data,$name);
            }
        }
        //Не натиснута кнопка "Оновити"
        else
        {
            $name='info_error';
            $data['info'] = 'Урок не був оновлений, томущо Ви не натиснули кнопки "Оновити"';
            $this->display_lib->admin_info_page($data,$name);
        }
    }
    
    //Видалення уроку
    public function delete_schedule($start_from = 0)
    {
        $this->auth_lib->check_admin();
        $this->load->model('schedule_model');
        
        $this->load->library('pagination');
        $this->load->library('pagination_lib');
        
        $data = array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //Якщо не натиснута кнопка "Видалити"
        if ( ! isset($_POST['delete_button']))
        {
            //Задаємо обмеження числа уроків на сторінку 
            $limit = $this->config->item('admin_per_page');
            
            //Рахуємо загальну кількість уроків
            $total = $this->schedule_model->count_all();
            
            //Налаштування (для чого навігація, ім'я для підстановки до base_url, всі, обмеження)
            $settings = $this->pagination_lib->get_settings('schedule_delete','',$total,$limit);
            
            //Застосовуємо налаштування
            $this->pagination->initialize($settings);            
        
            //Список уроків, розбитий відповідно до pagination   
            $data['schedule_list'] = $this->schedule_model->get_other_pagination_admin($limit,$start_from); 
            
            //Ссилки pagination
            $data['page_nav'] = $this->pagination->create_links(); 
            
            $name = 'schedule/delete';    
            $this->display_lib->admin_page($data,$name);
        }
        //Якщо кнопка "Видалити" натиснута
        else
        {
            //але не вибраний урок
            if ( ! isset($_POST['schedule_id']))
            {
                $name='info_error';
                $data['info'] = 'Не вибраний урок для видалення';
                $this->display_lib->admin_info_page($data,$name);        
            }
            //вибраний урок для видалення
            else 
            {
                //Отримуємо ідентифікатор уроку з масиву POST
                $schedule_id = $this->input->post('schedule_id');
                
                //Видаляємо урок з вибраним ідентифікатором
                $this->schedule_model->delete($schedule_id);           
                
                $name='info_ok';
                $data['info'] = 'Урок видалений';
                $this->display_lib->admin_info_page($data,$name);
            }
        }
    }
}
?>