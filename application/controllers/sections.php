<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sections extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('sections_model');
    }
    
    public function index()
    {
        redirect (base_url());
    }
    
    //start_from - з якого матеріалу починати вивід для кожної сторінки
    //розбитої за допомогою pagination
    public function show($section_id,$start_from = 0)
    {
        $this->load->library('pagination');
        $this->load->library('pagination_lib');
        
        $data = array();
        
        //календар
        $data['calendar'] = $this->calendar->generate();
        
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
        
        //масив по одній категорії;
        $data['main_info'] = $this->sections_model->get($section_id);
        
        //витягуємо з бази всі запитання до голосування
        $data['questions_vote_all']= $this->ques_model->get_other(); 
        
        //витягуємо з бази всі відповіді для голосування
        $data['options_vote_all']= $this->options_model->get_other();
        
        //витягуємо з бази останні оновлені матеріали
        $data['update_materias']= $this->materials_model->update_materias();
        
        //витягуємо з бази останні оновлені матеріали
        $data['update_materias']= $this->materials_model->update_materias();
                              
        //Якщо масив пустий
        if (empty($data['main_info']))
        {
            $data['info'] = 'Такої категорії не існує';
            $data['title_info'] = 'Інформаційне повідомлення';
            $name = 'info_error';
            $this->display_lib->user_info_page($data,$name);
        }
        else
        {
            //Задаємо обмеження кількості матераілів на сторінку
            $limit = $this->config->item('user_per_page');
            
            //Зчитуємо загальну кількість матеріалів в конкретній категорії
            $total = $this->materials_model->count_by($section_id);
            
            //Налаштування (для чого навігація, ім'я для підставлення до base_url, вього, обмеження)
            $settings = $this->pagination_lib->get_settings('section',$section_id,$total,$limit);
            
            //Застосовуємо настройки
            $this->pagination->initialize($settings);
            
            //Отримуємо список матеріалів, що розбитий відповідно з настройками
            $data['materials_list'] = $this->materials_model->get_by($section_id,$limit,$start_from);
            
            //Отримуємо код ссилок посторінкової навігації
            $data['page_nav'] = $this->pagination->create_links();
            $name = 'sections/content';
            $this->display_lib->user_page($data,$name);
        }
    }
    
    //Добавлення нової категорії
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
            $this->form_validation->set_rules($this->sections_model->add_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                $add_ok = $this->input->post('section_id');
                $add_mas = $this->sections_model->get_admin($add_ok);
                
                if (empty($add_mas['section_id']))
                {
                    //Викликаємо функцію добавлення категорії
                    $this->sections_model->add();
                    
                    $name = 'info_ok';
                    $data['info'] = 'Категорія добавлена';
                    $this->display_lib->admin_info_page($data,$name);
                }  
                else
                {
                    $name = 'info_error';
                    $data['info'] = 'Така категорія вже існує';
                    $this->display_lib->admin_info_page($data,$name);
                }
            }
            else
            {
                $name = 'sections/add';
                //Передаємо пустий масив data так, як цього потребує функція admin_page 
                $this->display_lib->admin_page($data,$name);           
            }
        }
              
        //Якщо не натиснута кнопка "Додати", виводимо порожню форму
        else
        {                      
            $name = 'sections/add';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //Редагування (вивід списку категорій для вибору)  
    public function edit_list()
    {
        $this->auth_lib->check_admin();
        
        //Масив з всіма категоріями для виводу списку
        
        $data = array('sections_list' => $this->sections_model->get_other_admin());
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        $name = 'sections/edit_list';
    
        $this->display_lib->admin_page($data,$name);
    }
    
    //Редагування (форма із значеннями, які беруться з бази)
    public function edit($section_id = '')
    {
        $this->auth_lib->check_admin();
        
        $this->load->helper('tinymce');
        $this->load->helper('radio');
        
        //Формуємо масив однієї категорії (row_array) для відображення у формі редагування 
        $data=array();
        $data = $this->sections_model->get_admin($section_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
           
        //Якщо масив пустий
        if (empty($data['section_id']))
        {
            $name = 'info_error';
            $data['info'] = 'Такої категорії не існує';       
            $this->display_lib->admin_info_page($data,$name);               
        }
        else
        {
            $data['names_pub'] = $this->sections_model->get_publish_values($section_id);
            $name = 'sections/edit';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //Оновлення категорії в базі даних)
    public function update($section_id = '')
    {
        $this->auth_lib->check_admin();
        
        //$this->load->helper('tinymce'); 
        
        $data=array();
        $data = $this->sections_model->get_admin($section_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //Якщо натиснута кнопка "Оновити"
        if (isset($_POST['update_button']))
        {
            $this->form_validation->set_rules($this->sections_model->update_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                //Оновляємо категорію
                $this->sections_model->update($section_id);
                
                $name='info_ok';
                $data['info'] = 'Категорія оновлена';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                //Формуємо масив з даними категорії для підстановки в поля форми (ті, що не пройшли валідацію, беруться з бази, а ті, що пройшли - з масиву POST)
                $data = $this->sections_model->get_admin($section_id);
                $data['menu_top'] = $this->menu_top_model->get_other();
                $data['menu_main'] = $this->menu_main_model->get_other();
                $data['img_footer'] = $this->img_footer_model->get_other();
               
                $name = 'sections/edit';
                $this->display_lib->admin_page($data,$name);
            }
        }
        //Не натиснута кнопка "Оновити"
        else
        {
            $name='info_error';
            $data['info'] = 'Категорія не була оновлена, томущо Ви не натиснули кнопку "Оновити"';
            $this->display_lib->admin_info_page($data,$name);
        }
    }
    
    //Видалення категорії
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
            //Масив з всіма сторінками
            $data['sections_list'] = $this->sections_model->get_other_admin();
            $name = 'sections/delete';
    
            $this->display_lib->admin_page($data,$name);
        }
        
        //Якщо натиснута кнопка "Видалити"
        else
        {
            //але не вибрана категорія
            if ( ! isset($_POST['section_id']))
            {
                $name='info_error';
                $data['info'] = 'Не вибрана категорія для видалення';
                $this->display_lib->admin_info_page($data,$name);                      
            }
    
            //і вибрана сторінка
            else 
            {
                //Отримуємо ідентифікатор сторінки з масиву POST
                $section_id = $this->input->post('section_id');
                
                //Видаляємо сторінку з вибраним ідентифікатором
                $this->sections_model->delete($section_id);                         
                
                $name='info_ok';
                $data['info'] = 'Категорія видалена';                  
                $this->display_lib->admin_info_page($data,$name);            
            }
        }
    }




}
?>