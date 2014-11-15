<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Polls extends CI_Controller
{
       
    public function index()
    {        
        redirect (base_url());
    }
    
    public function poll()
    {
        $this->load->helper('cookie');
        $this->load->model('votes_model');
        
            
        //формуємо елементи, які потрібні в будь-якому випадку
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
        
        if (isset($_POST['result_button']))
        {
            
            $poll_id = $data['questions_vote_all'][0]['ques_id'];
            $data['count_votes'] = $this->votes_model->count_votes($poll_id);
            $data['showresults_all']= $this->votes_model->showresults($poll_id);
            $data['first_vote']= $this->votes_model->get_first_vote();
            $data['last_vote']= $this->votes_model->get_last_vote();
            $data['info_vote']='';
            $data['title_info']='Результати голосування';
            $name = 'admin/vote';
            $this->display_lib->user_info_page($data,$name);  
        }
        else
        {
            $poll = $this->input->post('poll',TRUE);
            $poll_id = $data['questions_vote_all'][0]['ques_id'];
            $current_date = date("Y-m-d");
            $ip_add = $this->input->server('REMOTE_ADDR',TRUE);
            $ip_result = $this->votes_model->get_ip($ip_add);
            
            if (isset($_POST['vote_button']) AND isset($_POST['poll']))
            {
                $result_cook = get_cookie('voted', true);
                if(($result_cook == FALSE) AND (empty($ip_result)))
                {
                    $this->votes_model->get_insert_record($poll, $current_date);
                    set_cookie('voted','voted',86400*365);
                    $data['info_vote_ok']='Дякуємо за Ваш Голос!';
                    $data['count_votes'] = $this->votes_model->count_votes($poll_id);
                    $data['showresults_all']= $this->votes_model->showresults($poll_id);
                    $data['first_vote']= $this->votes_model->get_first_vote();
                    $data['last_vote']= $this->votes_model->get_last_vote(); 
                    $name = 'admin/vote_ok';
                    $data['title_info']='Результати голосування';
                    $this->display_lib->user_info_page($data,$name);
                }
                else
                {
                    $data['info_vote']='Ви вже проголосували!';
                
                $data['count_votes'] = $this->votes_model->count_votes($poll_id);
                $data['showresults_all']= $this->votes_model->showresults($poll_id);
                $data['first_vote']= $this->votes_model->get_first_vote();
                $data['last_vote']= $this->votes_model->get_last_vote(); 
                $name = 'admin/vote';
                $data['title_info']='Результати голосування';
                $this->display_lib->user_info_page($data,$name);
                }
            }
            else
            {
                $data['info_vote']='Ваш вибір не був зроблений, будь-ласка, спробуйте ще раз!'; 
                $data['count_votes'] = $this->votes_model->count_votes($poll_id);
                $data['showresults_all']= $this->votes_model->showresults($poll_id);
                $data['first_vote']= $this->votes_model->get_first_vote();
                $data['last_vote']= $this->votes_model->get_last_vote(); 
                $data['title_info']='Результати голосування';
                $name = 'admin/vote';
                $this->display_lib->user_info_page($data,$name);
            }
        }
    }
    
    //Редагування (вивід списку запитань для вибору)  
    public function edit_list_ques()
    {
        $this->auth_lib->check_admin();
        
        $this->load->model('ques_model');
        
        //Масив з всіма сторінками для виводу списку
        
        $data = array('ques_list' => $this->ques_model->get_other_admin());
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        $name = 'ques/edit_list';
        
        $this->display_lib->admin_page($data,$name);
    }
    
    //Редагування (форма із значеннями, які беруться з бази)
    public function edit_ques($ques_id = '')
    {
        $this->auth_lib->check_admin();
                       
        //Формуємо масив одного запитання (row_array) для відображення у формі редагування 
        $data=array();
        $data = $this->ques_model->get_admin($ques_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
           
        //Якщо масив пустий
        if (empty($data['ques_id']))
        {
            $name = 'info_error';
            $data['info'] = 'Такого запитання для голосування не існує';       
            $this->display_lib->admin_info_page($data,$name);               
        }
        else
        {
            $name = 'ques/edit';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //Оновлення запитання до голосування в базі даних)
    public function update_ques($ques_id = '')
    {
        $this->auth_lib->check_admin();
        
        $data=array();
        $data = $this->ques_model->get_admin($ques_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //Якщо натиснута кнопка "Оновити"
        if (isset($_POST['update_button']))
        {
            $this->form_validation->set_rules($this->ques_model->update_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                //Оновлюємо запитання для голосування
                $this->ques_model->update($ques_id);
                
                $name='info_ok';
                $data['info'] = 'Запитання для голосування оновлено';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                //Формуємо масив з даними запитання для підстановки в поля форми (ті, що не пройшли валідацію, беруться з бази, а ті, що пройшли - з масиву POST)
                $data = $this->ques_model->get_admin($ques_id);
                $data['menu_top'] = $this->menu_top_model->get_other();
                $data['menu_main'] = $this->menu_main_model->get_other();
                $data['img_footer'] = $this->img_footer_model->get_other();
               
                $name = 'ques/edit';
                $this->display_lib->admin_page($data,$name);
            }
        }
        //Не натиснута кнопка "Оновити"
        else
        {
            $name='info_error';
            $data['info'] = 'Запитання для голосування не було оновлено, томущо Ви не натиснули кнопку "Оновити"';
            $this->display_lib->admin_info_page($data,$name);
        }
    }
    
    //Добавлення нової відповіді для голосування
    public function add_options()
    {
        $this->auth_lib->check_admin();
        
        $data=array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //Якщо натиснута кнопка "Додати"  
        if (isset($_POST['add_button']))      
        {
            $this->form_validation->set_rules($this->options_model->add_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                $add_ok = $this->input->post('option_id');
                $add_mas = $this->options_model->get_admin($add_ok);
                
                //Викликаємо функцію добавлення запитання для голосування
                $this->options_model->add();
                
                $name = 'info_ok';
                $data['info'] = 'Запитання для голосування добавлено';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                $name = 'options/add';
                //Передаємо пустий масив data так, як цього потребує функція admin_page 
                $this->display_lib->admin_page($data,$name);           
            }
        }
              
        //Якщо не натиснута кнопка "Додати", виводимо порожню форму
        else
        {                      
            $name = 'options/add';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //Редагування (вивід списку відповідей для голосування для вибору)  
    public function edit_list_options()
    {
        $this->auth_lib->check_admin();
        
        //Масив з всіма відповідями для голосування для виводу списку
        
        $data = array('options_list' => $this->options_model->get_other_admin());
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        $name = 'options/edit_list';
    
        $this->display_lib->admin_page($data,$name);
    }
    
    //Редагування (форма із значеннями, які беруться з бази)
    public function edit_options($option_id = '')
    {
        $this->auth_lib->check_admin();
        
        $this->load->helper('radio');
        
        //Формуємо масив однієї відповіді для голосування (row_array) для відображення у формі редагування 
        $data=array();
        $data = $this->options_model->get_admin($option_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
           
        //Якщо масив пустий
        if (empty($data['option_id']))
        {
            $name = 'info_error';
            $data['info'] = 'Такої відповіді для голосування не існує';       
            $this->display_lib->admin_info_page($data,$name);               
        }
        else
        {
            $data['names_pub'] = $this->options_model->get_publish_values($option_id);
            $name = 'options/edit';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //Оновлення відповіді для голосування в базі даних)
    public function update_options($option_id = '')
    {
        $this->auth_lib->check_admin();
        
        $data=array();
        $data = $this->options_model->get_admin($option_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //Якщо натиснута кнопка "Оновити"
        if (isset($_POST['update_button']))
        {
            $this->form_validation->set_rules($this->options_model->update_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                //Оновлюємо відповідь для голосування
                $this->options_model->update($option_id);
                
                $name='info_ok';
                $data['info'] = 'Відповідь для голосування оновлена';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                //Формуємо масив з даними відповіді для підстановки в поля форми (ті, що не пройшли валідацію, беруться з бази, а ті, що пройшли - з масиву POST)
                $data = $this->options_model->get_admin($option_id);
                $data['menu_top'] = $this->menu_top_model->get_other();
                $data['menu_main'] = $this->menu_main_model->get_other();
                $data['img_footer'] = $this->img_footer_model->get_other();
               
                $name = 'options/edit';
                $this->display_lib->admin_page($data,$name);
            }
        }
        //Не натиснута кнопка "Оновити"
        else
        {
            $name='info_error';
            $data['info'] = 'Відповідь для голосування не була оновлена, томущо Ви не натиснули кнопку "Оновити"';
            $this->display_lib->admin_info_page($data,$name);
        }
    }
    
    //Видалення відповіді для голосування
    public function delete_options()
    {
        $this->auth_lib->check_admin();
        
        $data=array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //Якщо не натиснута кнопка "Видалити"
        if ( ! isset($_POST['delete_button']))
        {
            //Масив з всіма відповідями для голосування
            $data['options_list'] = $this->options_model->get_other_admin();
            $name = 'options/delete';
    
            $this->display_lib->admin_page($data,$name);
        }
        
        //Якщо натиснута кнопка "Видалити"
        else
        {
            //але не вибрана відповідь для голосування
            if ( ! isset($_POST['option_id']))
            {
                $name='info_error';
                $data['info'] = 'Не вибрана відповідь для видалення';
                $this->display_lib->admin_info_page($data,$name);                      
            }
    
            //і вибрана відповідь для голосування
            else 
            {
                //Отримуємо ідентифікатор відповіді для голосування з масиву POST
                $option_id = $this->input->post('option_id');
                
                //Видаляємо відповідь для голосування з вибраним ідентифікатором
                $this->options_model->delete($option_id);                         
                
                $name='info_ok';
                $data['info'] = 'Відповідь для голосування видалена';                  
                $this->display_lib->admin_info_page($data,$name);            
            }
        }
    }
    
    //Редагування (вивід списку результатів голосування для вибору)  
    public function edit_list_votes()
    {
        $this->auth_lib->check_admin();
        
        $this->load->model('votes_model');
        
        //Масив з всіма результатами голосування для виводу списку
        
        $data = array('votes_list' => $this->votes_model->get_other_admin());
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        $name = 'votes/edit_list';
    
        $this->display_lib->admin_page($data,$name);
    }
    
    //Редагування (форма із значеннями, які беруться з бази)
    public function edit_votes($vote_id = '')
    {
        $this->auth_lib->check_admin();
        
        $this->load->model('votes_model');
        $this->load->helper('radio');
        
        //Формуємо масив одного результату голосування (row_array) для відображення у формі редагування 
        $data=array();
        $data = $this->votes_model->get_admin($vote_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
           
        //Якщо масив пустий
        if (empty($data['vote_id']))
        {
            $name = 'info_error';
            $data['info'] = 'Такого результату голосування не існує';       
            $this->display_lib->admin_info_page($data,$name);               
        }
        else
        {
            $data['names_pub'] = $this->votes_model->get_publish_values($vote_id);
            $name = 'votes/edit';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //Оновлення результатів голосування в базі даних)
    public function update_votes($vote_id = '')
    {
        $this->auth_lib->check_admin();
        
        $this->load->model('votes_model');
        
        $data=array();
        $data = $this->votes_model->get_admin($vote_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //Якщо натиснута кнопка "Оновити"
        if (isset($_POST['update_button']))
        {
            $this->form_validation->set_rules($this->votes_model->update_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                //Оновлюємо результат голосування
                $this->votes_model->update($vote_id);
                
                $name='info_ok';
                $data['info'] = 'Результат голосування оновлений';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                //Формуємо масив з даними результату голосування для підстановки в поля форми (ті, що не пройшли валідацію, беруться з бази, а ті, що пройшли - з масиву POST)
                $data = $this->votes_model->get_admin($vote_id);
                $data['menu_top'] = $this->menu_top_model->get_other();
                $data['menu_main'] = $this->menu_main_model->get_other();
                $data['img_footer'] = $this->img_footer_model->get_other();
               
                $name = 'votes/edit';
                $this->display_lib->admin_page($data,$name);
            }
        }
        //Не натиснута кнопка "Оновити"
        else
        {
            $name='info_error';
            $data['info'] = 'Результат голосування не був оновлений, томущо Ви не натиснули кнопку "Оновити"';
            $this->display_lib->admin_info_page($data,$name);
        }
    }
    
    //Видалення результату голосування
    public function delete_votes()
    {
        $this->auth_lib->check_admin();
        
        $this->load->model('votes_model');
        
        $data=array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //Якщо не натиснута кнопка "Видалити"
        if ( ! isset($_POST['delete_button']))
        {
            //Масив з всіма результатами голосування
            $data['votes_list'] = $this->votes_model->get_other_admin();
            $name = 'votes/delete';
    
            $this->display_lib->admin_page($data,$name);
        }
        
        //Якщо натиснута кнопка "Видалити"
        else
        {
            //але не вибраний результат голосування
            if ( ! isset($_POST['vote_id']))
            {
                $name='info_error';
                $data['info'] = 'Не вибраний результат голосування для видалення';
                $this->display_lib->admin_info_page($data,$name);                      
            }
    
            //і вибраний результат голосування для видалення
            else 
            {
                //Отримуємо ідентифікатор результату голосування з масиву POST
                $vote_id = $this->input->post('vote_id');
                
                //Видаляємо результат голосування з вибраним ідентифікатором
                $this->votes_model->delete($vote_id);                         
                
                $name='info_ok';
                $data['info'] = 'Результат голосування видалений';                  
                $this->display_lib->admin_info_page($data,$name);            
            }
        }
    }
}
?>