<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pages extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pages_model');
        //$this->load->library('breadcrumb_lib');
    }
    
    public function index()
    {
        redirect(base_url());
    }
    
    public function show($page_id)
    {
        //формуємо масив для передавання у вид;
        $data=array();
        
        //календар
        $data['calendar'] = $this->calendar->generate();
        
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
        
        //масив по одній сторінці;
        $data['main_info'] = $this->pages_model->get($page_id);
        
        //витягуємо з бази всі запитання до голосування
        $data['questions_vote_all']= $this->ques_model->get_other();
        
        //витягуємо з бази всі відповіді для голосування
        $data['options_vote_all']= $this->options_model->get_other();
        
        //витягуємо з бази останні оновлені матеріали
        $data['update_materias']= $this->materials_model->update_materias();
        
        switch ($page_id)
        {
            //якщо сторінка "Головна"
            case 'index':
            //Якщо масив пустий
            if (empty($data['main_info']))
            {
                $data['info'] = 'Немає такої сторінки';
                $data['title_info'] = 'Інформаційне повідомлення';
                $name = 'info_error';
                $this->display_lib->user_info_page($data, $name);
            }
            else
            {
                $name = 'pages/mainpage';
                $this -> display_lib->user_page($data, $name);
            }
            break;
            
            //якщо сторінка "Контакти"
            case 'contact':
            $this->load->library('captcha_lib');
            
            //не натиснута кнопка "Відправити"
            if(! isset($_POST['send_message']))
            {
            //отримуємо код картинки
            $data['imgcode'] = $this->captcha_lib->captcha_actions();
            $data['info'] = ''; //інформаційне повідомлення
            $name = 'pages/contact';
            $this->display_lib->user_page($data, $name);
            }
            
            //нажата кнопка "Відправити"
            else
            {
                //встановлення правил валідації
                $this->form_validation->set_rules($this->pages_model->contact_rules);
                $val_res = $this->form_validation->run();
                
                //якщо валідація виконана
                if ($val_res == TRUE)
                {
                    //отримуємо значення поля капча
                    $entered_captcha = $this->input->post('captcha');
                
                //якщо капча співпадає - відправляємо повідомлення
                if ($entered_captcha == $this->session->userdata('rnd_captcha'))
                {
                    $this->load->library('typography');
                    
                    //ім'я відправника
                    $name = $this->input->post('name');
                    
                    //вказаний відправником email
                    $email = $this->input->post('email');
                    
                    //тема повідомлення, вказана відправником
                    $topic = $this->input->post('topic');
                    
                    //текст повідомлення
                    $text = $this->input->post('message');
                    
                    //перенос після 70 знаків (обмеження mail в PHP)
                    $text = wordwrap($text,70);
                    
                    //TRUE - більше двох переводів рядків все одно рахується за два переводи рядка
                    $text = $this->typography->auto_typography($text, TRUE);
                    
                    //Видаляємо html-теги для зручності читання
                    $text = strip_tags($text);
                    
                    //Куда відправляється повідомлення
                    $address = "admin@vyshnya.lviv.ua";
                    
                    //Тема повідомлення, як його бачить отримувач
                    $subject = "Запитання із форми зворотнього зв'яка";
                    $message = "Написав(ла):$name\nТема: $topic\nПовідомлення:\n$text\nE-mail відправника: $email";
                    
                    //Відправляємо повідомлення
                    mail ($address,$subject,$message,"Content-type:text/plain;charset = windows-1251\r\n");
                    $data['info'] = 'Ваше повідомлення відправлено. Якщо воно потребує відповіді, ми зв\'жемося з вами
                    найближчим часом.';
                    $data['title_info'] = 'Ваше повідомлення відправлено';
                    $name = 'info_ok';
                    $this->display_lib->user_info_page($data,$name);
                    }
                //якщо капча не співпадає
                else
                {
                    //Отримуємо код картинки
                    $data['imgcode'] = $this->captcha_lib->captcha_actions();
                    $data['info'] = 'Неправильно введені цифри з картинки';
                    $data['title_info'] = 'Неправильно введені цифри з картинки';
                    $name = 'pages/contact';
                    $this->display_lib->user_page($data,$name);
                    
                }
            }
            //якщо валідація не співпадає
            else
            {
            //Отримуємо код картинки
            $data['imgcode'] = $this->captcha_lib->captcha_actions();
            $data['info'] ='';//інформаційне повідолення
            $name = 'pages/contact';
            $this->display_lib->user_page($data,$name);
            }
        }
        break;
        
        //якщо сторінка "world_sites"
        case 'world_sites':
        $this->load->library('captcha_lib');
        
        //не натиснута кнопка "Відправити"
        if(! isset($_POST['send_message']))
        {
        //отримуємо код картинки
        $data['imgcode'] = $this->captcha_lib->captcha_actions();
        $data['info'] = ''; //інформаційне повідомлення
        
        $name = 'pages/world_sites';
        $this->display_lib->user_page($data, $name);
        }
        
        //нажата кнопка "Відправити"
        else
        {
            //встановлення правил валідації
            $this->form_validation->set_rules($this->pages_model->contact_rules);
            $val_res = $this->form_validation->run();
            
            //якщо валідація виконана
            if ($val_res == TRUE)
            {
                //отримуємо значення поля капча
                $entered_captcha = $this->input->post('captcha');
            
            //якщо капча співпадає - відправляємо повідомлення
            if ($entered_captcha == $this->session->userdata('rnd_captcha'))
            {
                $this->load->library('typography');
                
                //ім'я відправника
                $name = $this->input->post('name');
                
                //вказаний відправником email
                $email = $this->input->post('email');
                
                //тема повідомлення, вказана відправником
                $topic = $this->input->post('topic');
                
                //текст повідомлення
                $text = $this->input->post('message');
                
                //перенос після 70 знаків (обмеження mail в PHP)
                $text = wordwrap($text,70);
                
                //TRUE - більше двох переводів рядків все одно рахується за два переводи рядка
                $text = $this->typography->auto_typography($text, TRUE);
                
                //Видаляємо html-теги для зручності читання
                $text = strip_tags($text);
                
                //Куда відправляється повідомлення
                $address = "oleh_mandryk@vyshnya.lviv.ua";
                
                //Тема повідомлення, як його бачить отримувач
                $subject = "Запитання із форми зворотнього зв'яка";
                $message = "Написав(ла):$name\nТема: $topic\nПовідомлення:\n$text\nE-mail відправника: $email";
                
                //Відправляємо повідомлення
                mail ($address,$subject,$message,"Content-type:text/plain;charset = windows-1251\r\n");
                $data['info'] = 'Ваше повідомлення відправлено. Якщо воно потребує відповіді, ми зв\'жемося з вами
                найближчим часом.';
                $data['title_info'] = 'Ваше повідомлення відправлено';
                $name = 'info_ok';
                $this->display_lib->user_info_page($data,$name);
                }
            //якщо капча не співпадає
            else
            {
                //Отримуємо код картинки
                $data['imgcode'] = $this->captcha_lib->captcha_actions();
                $data['info'] = 'Неправильно введені цифри з картинки';
                $data['title_info'] = 'Неправильно введені цифри з картинки';
                $name = 'pages/world_sites';
                $this->display_lib->user_page($data,$name);
                
            }
        }
        //якщо валідація не співпадає
        else
        {
        //Отримуємо код картинки
        $data['imgcode'] = $this->captcha_lib->captcha_actions();
        $data['info'] ='';//інформаційне повідолення
        $name = 'pages/world_sites';
        $this->display_lib->user_page($data,$name);
        }
    }
    break;
            
            //якщо сторінка "Карта сайту"
            case 'map':
            //Якщо масив пустий
            if (empty($data['main_info']))
            {
                $data['info'] = 'Немає такої сторінки';
                $data['title_info'] = 'Інформаційне повідомлення';
                $name = 'info_error';
                $this->display_lib->user_info_page($data, $name);
            }
            else
            {
                $data['all_materials'] = $this->materials_model->all_materials();
                $name = 'pages/map';
                $this -> display_lib->user_page($data, $name);
            }
            break;
            
            // Будь-яка інша сторінка
             default:
             //Якщо масив пустий
             if (empty($data['main_info']))
             {
                $data['info'] = 'Немає такої сторінки';
                $data['title_info'] = 'Інформаційне повідомлення';
                $name = 'info_error';
                $this->display_lib->user_info_page($data, $name);
             }
             else
             {
                $name = 'pages/page';
                $this -> display_lib->user_page($data, $name);
                 
             }
             break;
        }
   }
   
    //Добавлення нової сторінки
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
            $this->form_validation->set_rules($this->pages_model->add_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                $add_ok = $this->input->post('page_id');
                $add_mas = $this->pages_model->get_admin($add_ok);
                
                if (empty($add_mas['page_id']))
                {
                    //Викликаємо функцію добавлення сторінки
                    $this->pages_model->add();
                    
                    $name = 'info_ok';
                    $data['info'] = 'Сторінка добавлена';
                    $this->display_lib->admin_info_page($data,$name);
                }  
                else
                {
                    $name = 'info_error';
                    $data['info'] = 'Така сторінка вже існує';
                    $this->display_lib->admin_info_page($data,$name);
                }
            }
            else
            {
                $name = 'pages/add';
                //Передаємо пустий масив data так, як цього потребує функція admin_page 
                $this->display_lib->admin_page($data,$name);           
            }
        }
              
        //Якщо не натиснута кнопка "Додати", виводимо порожню форму
        else
        {                      
            $name = 'pages/add';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //Редагування (вивід списку сторінок для вибору)  
    public function edit_list()
    {
        $this->auth_lib->check_admin();
        
        //Масив з всіма сторінками для виводу списку
        
        $data = array('pages_list' => $this->pages_model->get_other_admin());
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        $name = 'pages/edit_list';
    
        $this->display_lib->admin_page($data,$name);
    }
    
    //Редагування (форма із значеннями, які беруться з бази)
    public function edit($page_id = '')
    {
        $this->auth_lib->check_admin();
        
        $this->load->helper('tinymce');
        $this->load->helper('radio');
        
        //Формуємо масив однієї сторінки (row_array) для відображення у формі редагування 
        $data=array();
        $data = $this->pages_model->get_admin($page_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
           
        //Якщо масив пустий
        if (empty($data['page_id']))
        {
            $name = 'info_error';
            $data['info_error'] = 'Такої сторінки не існує';       
            $this->display_lib->admin_info_page($data,$name);               
        }
        else
        {
            $data['names_pub'] = $this->pages_model->get_publish_values($page_id);
            $name = 'pages/edit';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //Оновлення сторінки в базі даних)
    public function update($page_id = '')
    {
        $this->auth_lib->check_admin();
        
        $this->load->helper('tinymce'); 
        
        $data=array();
        $data = $this->pages_model->get_admin($page_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //Якщо натиснута кнопка "Оновити"
        if (isset($_POST['update_button']))
        {
            $this->form_validation->set_rules($this->pages_model->update_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                //Оновляємо сторінку
                $this->pages_model->update($page_id);
                
                $name='info_ok';
                $data['info'] = 'Сторінка оновлена';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                //Формуємо масив з даними сторінки для підстановки в поля форми (ті, що не пройшли валідацію, беруться з бази, а ті, що пройшли - з масиву POST)
                $data = $this->pages_model->get_admin($page_id);
                $data['menu_top'] = $this->menu_top_model->get_other();
                $data['menu_main'] = $this->menu_main_model->get_other();
                $data['img_footer'] = $this->img_footer_model->get_other();
               
                $name = 'pages/edit';
                $this->display_lib->admin_page($data,$name);
            }
        }
        //Не натиснута кнопка "Оновити"
        else
        {
            $name='info_error';
            $data['info'] = 'Сторінка не була оновлена, томущо Ви не натиснули кнопку "Оновити"';
            $this->display_lib->admin_info_page($data,$name);
        }
    }
    
    //Видалення сторінки
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
            $data['pages_list'] = $this->pages_model->get_other_admin();
            $name = 'pages/delete';
    
            $this->display_lib->admin_page($data,$name);
        }
        
        //Якщо натиснута кнопка "Видалити"
        else
        {
            //але не вибрана сторінка
            if ( ! isset($_POST['page_id']))
            {
                $name='info_error';
                $data['info'] = 'Не вибрана сторінка для видалення';
                $this->display_lib->admin_info_page($data,$name);                      
            }
    
            //і вибрана сторінка
            else 
            {
                //Отримуємо ідентифікатор сторінки з масиву POST
                $page_id = $this->input->post('page_id');
                
                //Видаляємо сторінку з вибраним ідентифікатором
                $this->pages_model->delete($page_id);                         
                
                $name='info_ok';
                $data['info'] = 'Сторінка видалена';                  
                $this->display_lib->admin_info_page($data,$name);            
            }
        }
    }
}
?>