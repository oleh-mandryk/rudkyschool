<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Administration extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $this->auth_lib->check_admin();
        
        $this->load->model('pages_model');
        $this->load->model('sections_model');
        
        $data = array();
        
        //Всього матеріалів
        $data['materials_count'] = $this->materials_model->count_all();
        
        //Всього сторінок
        $data['pages_count'] = $this->pages_model->count_all(); 
        
        //Всього категорій
        $data['sections_count']    = $this->sections_model->count_all();
        
        //масив з пунктами категорій (головне меню);
        $data['menu_main'] = $this->menu_main_model->get_other();
        
        //масив з пунктами верхнього меню;
        $data['menu_top'] = $this->menu_top_model->get_other();
        
        //картинки для футера
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //витягуємо з бази останні оновлені матеріали
        $data['update_materias']= $this->materials_model->update_materias();
                      
        $name = 'main_admin';
        $this->display_lib->admin_page($data,$name);
    }
    
    public function preferences()
    {
        $this->auth_lib->check_admin();
        
        $data = array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //Якщо натиснута кнопка "Оновити"
        if (isset($_POST['update_button']))
        {
            //Встановлення правил валідації
            $this->form_validation->set_rules($this->administration_model->preferences_rules);
            
            //Якщо валідація успішно пройдена
            if ($this->form_validation->run() == TRUE)
            {
                //Заносимо в масив data отримані з форми змінні
                $data_admin = array();
                $data_admin['user_per_page']   = $this->input->post('user_per_page');
                $data_admin['admin_per_page']  = $this->input->post('admin_per_page');
                $data_admin['admin_login']     = $this->input->post('admin_login');
                $data_admin['admin_pass']      = $this->input->post('admin_pass');
                $data_admin['search_per_page'] = $this->input->post('search_per_page');
                $data_admin['user_per_photo'] = $this->input->post('user_per_photo');
                
                foreach ($data_admin as $key => $value)
                {    
                    //Оновлення в циклі для кожної настройки      
                    $this->db->where('pref_id',$key);
                    
                    //Другий параметр для update - масив (полю валу присвоюємо значення змінної $value)
                    $this->db->update('preferences',array('value' => $value));
                }
                
                $name='info_ok';
                $data['info'] = 'Налаштування оновлені';
                $this->display_lib->admin_info_page($data,$name);
            }
            
            //Якщо валідація не пройдена
            else
            {
                $name = 'preferences';
                $this->display_lib->admin_page($data,$name);
            }
        }
        
        //Кнопка "Оновити" не натиснута
        else
        {
            $name = 'preferences';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    public function login()
    {
        //Встановлення правил валідації
        $this->form_validation->set_rules($this->administration_model->login_rules);

        //Якщо валідація не пройдена
        if ($this->form_validation->run() == FALSE)
        {
            $this->display_lib->login_page();
        }

        //Якщо валідація пройдена, намагаємося ввійти
        else
        {
            $this->auth_lib->do_login($this->input->post('login'),$this->input->post('pass'));
        }
    }
    
    public function logout()
    {
        //Перевіряємо, чи був здійснений вхід
        $this->auth_lib->check_admin();//Тут перевірка не так обов'язкова в принципі
        $this->auth_lib->do_logout();
    }
  
    public function search($start_from = 0)
    {
        $this->load->library('pagination');
        $this->load->library('pagination_lib');
        
        //Для підсвічування пошукового запиту у вигляді(view) з результатами пошуку
        $this->load->helper('text'); 

        // Формируем элементы, нужные в любом случае
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
        
        //витягуємо з бази всі запитання до голосування
        $data['questions_vote_all']= $this->ques_model->get_other();
        
        //витягуємо з бази всі відповіді для голосування
        $data['options_vote_all']= $this->options_model->get_other();
        
        //витягуємо з бази останні оновлені матеріали
        $data['update_materias']= $this->materials_model->update_materias();
        
        //Задаємо кількість результатів пошуку на сторінку
        $limit = $this->config->item('search_per_page');
        
        //Якщо натуснута кнопка "Пошук"
        if (isset($_POST['search_button']))
        {  
            //Встановлюємо правила валідації
            $this->form_validation->set_rules($this->administration_model->search_rules);
            $val_res = $this->form_validation->run();

            // Формуємо масив з пустими значеннями
            $ses_search = array();
            $ses_search['val_passed'] = ''; // Чи пройшла валідація
            $ses_search['search_query'] = ''; // Пошуковий запит
            $this->session->set_userdata($ses_search);//Записуємо сесію
        
            //Якщо валідація пройдена 
            if ($val_res == TRUE)
            {
                //TRUE - фільтруємо на xss-атаку            
                $search = $this->input->post('search',TRUE);
            
                //Конвертуємо спеціальні символи в html-сутності, щоб введений запит не містив розмітки html
                $search = htmlspecialchars($search); 
                
                //Записуємо сесію після проходження валідації
                $ses_search = array();    
                
                //Валідація пройдена успішно для пошукового запиту       
                $ses_search['val_passed'] = 'yes'; 
                
                //Пошуковий запит
                $ses_search['search_query'] = $search;  
                
                //Записуємо сесію
                $this->session->set_userdata($ses_search);
                
                //Масив по знайдених матеріалах і сторінках
                $mpsearch_results = $this->administration_model->materials_pages_search($search,$limit,$start_from);
                       
                //Якщо масив пустий
                if (empty ($mpsearch_results))
                    {                      
                        $data['info'] = 'Інформація по Вашому запиту на знайдена';                             
                        $data['title_info']='Результати пошуку';
                        $name = 'info_error';
                        $this->display_lib->user_info_page($data,$name);
                    }
                //Пошук дав результат
                else
                {   
                    //Рахуємо загальну кількість сторінок, які  містять пошуковий запит
                    $total = $mpsearch_results['counter']; 
                
                    //Налаштування (для чого навігація, ім'я для підстановки до base_url, всього, обмеження)
                    $settings = $this->pagination_lib->get_settings('search','',$total,$limit);
                    
                    //Приймаємо налаштування
                    $this->pagination->initialize($settings);
                    
                    //Масив по знайдених матеріалах і сторінках
                    $data['mpsearch_results'] = $mpsearch_results;
                                    
                    //посилання pagination         
                    $data['page_nav'] = $this->pagination->create_links();
                     
                    $name = 'admin/search';
                    $data['title_info']='Результати пошуку';
                    $this->display_lib->user_info_page($data,$name);            
                }
            }
            //Якщо валідація не пройдена
            else
            {
                $data['info'] = 'Неправильні параметри пошуку';                              
                $data['title_info']='Неправильні параметри пошуку';
                $name = 'info_error';                  
                $this->display_lib->user_info_page($data,$name);
            }
        }
        //Якщо не нажата кнопка "Пошук"
        else
        {
        //Але в сесії зберігається інформація про успішно пройдену валідацію
        if ($this->session->userdata('val_passed') === 'yes')
        {
            //Заносимо в змінну search рядок пошукового запиту, що збережений в сесії
            $search = $this->session->userdata('search_query');

            //Масив по знайдених матеріалах і сторінках
            $mpsearch_results = $this->administration_model->materials_pages_search($search,$limit,$start_from);
                        
            // Якщо масив пустий
            if (empty ($mpsearch_results))
            {                       
                $data['info'] = 'Інформація по Вашому запиту не знайдена';                             
                $data['title_info']='Результати пошуку';
                $name = 'info';
                $this->display_lib->user_info_page($data,$name);            
            }
            // Пошук дав результат
            else
            {
                //Рахуємо загальну кількість сторінок, які містять пошуковий запит
                $total = $mpsearch_results['counter'];
                
                //Налаштування (для чого навігація, ім'я для підстановки до base_url, всього, обмеження)
                $settings = $this->pagination_lib->get_settings('search','',$total,$limit);

                //Приймаємо налаштування
                $this->pagination->initialize($settings);
                
                //Масив по знайдених матеріалах і сторінках
                $data['mpsearch_results']  = $mpsearch_results;
                                               
                //посилання pagination
                $data['page_nav'] = $this->pagination->create_links(); 
                $data['title_info']='Результати пошуку';
                $name = 'admin/search';           
                $this->display_lib->user_info_page($data,$name);
            }
        }
        // и в сессии нет информации об успешном прохождении валидации
        else
        {
            $data['info'] = 'Неправильні параметри пошуку';                          
            $data['title_info']='Неправильні параметри пошуку';
            $name = 'info_error';
            $this->display_lib->user_info_page($data,$name);
        }
        }
    }
    
}
?>