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
                
        //������� ����� ��� ����������� � ���;
        $data=array();
        
        //����� ��� ��������� ��������
        $data['schedule_date'] = $this->schedule_date_model->get($date_id=1);
        
        //����� � �������� �������� (������� ����);
        $data['menu_main'] = $this->menu_main_model->get_other();
        
        //����� � �������� ��������� ����;
        $data['menu_top'] = $this->menu_top_model->get_other();
        
        //�������� ��� ������
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //����� �� ������ �����
        $data['i_wonder'] = $this->i_wonder_model->i_wonder($start_from_i_wonder = rand (0, $total = $this->i_wonder_model->count_all()-1));
        
        //����� �� ������ �����
        $data['winged_phrases'] = $this->winged_phrases_model->winged_phrases($start_from_winged_phrases = rand (0, $total = $this->winged_phrases_model->count_all()-1));
        
        //�������� � ���� �� ��������� �� �����������
        $data['questions_vote_all']= $this->ques_model->get_other();
        
        //�������� � ���� �� ������ ��� �����������
        $data['options_vote_all']= $this->options_model->get_other();
        
        //�������� � ���� ������ ������� ��������
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
            $data['title_info']='������� ������';
            $name = 'schedule/schedule_pupils';
            $this->display_lib->user_info_page($data,$name);
        }
        else
        {
            $data['groups_all'] = $this->schedule_model->get_class();
            $data['names_sel']='';
            $data['title_info']='������� ������';
            $name = 'schedule/schedule_pupils';
            $this->display_lib->user_info_page($data,$name);
        }
    }
    
    public function schedule_teachers()
    {
        $this->load->helper('radio');
        $this->load->model('schedule_model');
        $this->load->model('schedule_date_model');
                
        //������� ����� ��� ����������� � ���;
        $data=array();
        
        //����� ��� ��������� ��������
        $data['schedule_date'] = $this->schedule_date_model->get($date_id=1);
        
        //����� � �������� �������� (������� ����);
        $data['menu_main'] = $this->menu_main_model->get_other();
        
        //����� � �������� ��������� ����;
        $data['menu_top'] = $this->menu_top_model->get_other();
        
        //�������� ��� ������
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //����� �� ������ �����
        $data['i_wonder'] = $this->i_wonder_model->i_wonder($start_from_i_wonder = rand (0, $total = $this->i_wonder_model->count_all()-1));
        
        //����� �� ������ �����
        $data['winged_phrases'] = $this->winged_phrases_model->winged_phrases($start_from_winged_phrases = rand (0, $total = $this->winged_phrases_model->count_all()-1));
        
        //�������� � ���� �� ��������� �� �����������
        $data['questions_vote_all']= $this->ques_model->get_other();
        
        //�������� � ���� �� ������ ��� �����������
        $data['options_vote_all']= $this->options_model->get_other();
        
        //�������� � ���� ������ ������� ��������
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
            $data['title_info']='������� ������';
            $name = 'schedule/schedule_teachers';
            $this->display_lib->user_info_page($data,$name);
        }
        else
        {
            $data['teachers_all'] = $this->schedule_model->get_teachers();
            $data['names_sel']='';
            $data['title_info']='������� ������';
            $name = 'schedule/schedule_teachers';
            $this->display_lib->user_info_page($data,$name);
        }
    }
    
    //����������� (���� ������ ��� ������)  
    public function edit_list_schedule_date()
    {
        $this->auth_lib->check_admin();
        $this->load->model('schedule_date_model');
        //����� � ���� ��������� ��� ������ ������
        
        $data = array('schedule_date_list' => $this->schedule_date_model->get_other_admin());
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        $name = 'schedule_date/edit_list';
    
        $this->display_lib->admin_page($data,$name);
    }
    
    //����������� (����� �� ����������, �� �������� � ����)
    public function edit_schedule_date($date_id = '')
    {
        $this->auth_lib->check_admin();
        $this->load->model('schedule_date_model');
        
        //������� ����� (row_array) ��� ����������� � ���� ����������� 
        $data=array();
        $data = $this->schedule_date_model->get_admin($date_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
           
        //���� ����� ������
        if (empty($data['date_id']))
        {
            $name = 'info_error';
            $data['info'] = '���� ������ ����������� ���� �� ����';       
            $this->display_lib->admin_info_page($data,$name);               
        }
        else
        {
            $name = 'schedule_date/edit';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //��������� ������ ����������� ���� � ��� �����)
    public function update_schedule_date($date_id = '')
    {
        $this->auth_lib->check_admin();
        $this->load->model('schedule_date_model');
        
        $data=array();
        $data = $this->schedule_date_model->get_admin($date_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //���� ��������� ������ "�������"
        if (isset($_POST['update_button']))
        {
            $this->form_validation->set_rules($this->schedule_date_model->update_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                //��������� ����� ����������� ����
                $this->schedule_date_model->update($date_id);
                
                $name='info_ok';
                $data['info'] = '����� ����������� ���� ���������';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                //������� ����� � ������ ��� ���������� � ���� ����� (�, �� �� ������� ��������, �������� � ����, � �, �� ������� - � ������ POST)
                $data = $this->schedule_date_model->get_admin($date_id);
                $data['menu_top'] = $this->menu_top_model->get_other();
                $data['menu_main'] = $this->menu_main_model->get_other();
                $data['img_footer'] = $this->img_footer_model->get_other();
               
                $name = 'schedule_date/edit';
                $this->display_lib->admin_page($data,$name);
            }
        }
        //�� ��������� ������ "�������"
        else
        {
            $name='info_error';
            $data['info'] = '����� ����������� ���� �� ��� ���������, ������ �� �� ��������� ������ "�������"';
            $this->display_lib->admin_info_page($data,$name);
        }
    }
    
    //��������� �����
    public function add_schedule()
    {
        $this->auth_lib->check_admin();
        $this->load->model('schedule_model');
        
        $data=array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //���� ��������� ������ "������"  
        if (isset($_POST['add_button']))      
        {
            $this->form_validation->set_rules($this->schedule_model->add_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                //��������� ������� ���������� �����
                $this->schedule_model->add();
                $name = 'info_ok';
                $data['info'] = '���� ����������';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                $name = 'schedule/add';
                //�������� ������ ����� data ���, �� ����� ������� ������� admin_page 
                $this->display_lib->admin_page($data,$name);           
            }
        }
              
        //���� �� ��������� ������ "������", �������� ������� �����
        else
        {                      
            $name = 'schedule/add';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //����������� ����� (���� ������ ����� ��� ������)  
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
        
        //������ ��������� ����� ����� �� �������
        $limit = $this->config->item('admin_per_page');
        
        //������ �������� ������� �����
        $total = $this->schedule_model->count_all(); 
        
        //������������ (��� ���� ��������, ��'� ��� ���������� �� base_url, ��, ���������)
        $settings = $this->pagination_lib->get_settings('schedule_edit_list','',$total,$limit);
        
        //����������� ������������
        $this->pagination->initialize($settings);      
        
        //������ �����
        $data['schedule_list'] = $this->schedule_model->get_other_pagination_admin($limit,$start_from); 
        
        //������ pagination   
        $data['page_nav'] = $this->pagination->create_links();
        
        $name = 'schedule/edit_list';
        $this->display_lib->admin_page($data,$name);
    }
    
    //����������� �����
    public function edit_schedule($schedule_id = '')
    {
        $this->auth_lib->check_admin();
        
        $this->load->model('schedule_model');
        $this->load->helper('radio');    
                
        //������� ����� ���� ������� ����� ��� ����������� � ���� �����������
        $data = array();
        
        $data = $this->schedule_model->get_admin($schedule_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //���� ����� �������
        if (empty($data['schedule_id']))
        {
            $name='info_error';
            $data['info'] = '������ ����� �� ����';
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
    
    //��������� �����
    public function update_schedule($schedule_id = '')
    {
        $this->auth_lib->check_admin(); 
        
        $this->load->model('schedule_model');
        $this->load->helper('radio');
                
        $data = array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //���� ��������� ������ "�������"
        if (isset($_POST['update_button']))
        {
            $this->form_validation->set_rules($this->schedule_model->update_rules);
            if ($this->form_validation->run() == TRUE)
            {
                //��������� ����
                $this->schedule_model->update($schedule_id);
                
                $name='info_ok';
                $data['info'] = '���� ���������';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                //������� ����� � ������ ��� ���� ��� ���������� � ���� �����
                $data = $this->schedule_model->get_admin($schedule_id);
                $data['menu_top'] = $this->menu_top_model->get_other();
                $data['menu_main'] = $this->menu_main_model->get_other();
                $data['img_footer'] = $this->img_footer_model->get_other();
                $data['names_pub'] = $this->schedule_model->get_publish_values($schedule_id);                             
                
                $name = 'schedule/edit';
                $this->display_lib->admin_page($data,$name);
            }
        }
        //�� ��������� ������ "�������"
        else
        {
            $name='info_error';
            $data['info'] = '���� �� ��� ���������, ������ �� �� ��������� ������ "�������"';
            $this->display_lib->admin_info_page($data,$name);
        }
    }
    
    //��������� �����
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
        
        //���� �� ��������� ������ "��������"
        if ( ! isset($_POST['delete_button']))
        {
            //������ ��������� ����� ����� �� ������� 
            $limit = $this->config->item('admin_per_page');
            
            //������ �������� ������� �����
            $total = $this->schedule_model->count_all();
            
            //������������ (��� ���� ��������, ��'� ��� ���������� �� base_url, ��, ���������)
            $settings = $this->pagination_lib->get_settings('schedule_delete','',$total,$limit);
            
            //����������� ������������
            $this->pagination->initialize($settings);            
        
            //������ �����, �������� �������� �� pagination   
            $data['schedule_list'] = $this->schedule_model->get_other_pagination_admin($limit,$start_from); 
            
            //������ pagination
            $data['page_nav'] = $this->pagination->create_links(); 
            
            $name = 'schedule/delete';    
            $this->display_lib->admin_page($data,$name);
        }
        //���� ������ "��������" ���������
        else
        {
            //��� �� �������� ����
            if ( ! isset($_POST['schedule_id']))
            {
                $name='info_error';
                $data['info'] = '�� �������� ���� ��� ���������';
                $this->display_lib->admin_info_page($data,$name);        
            }
            //�������� ���� ��� ���������
            else 
            {
                //�������� ������������� ����� � ������ POST
                $schedule_id = $this->input->post('schedule_id');
                
                //��������� ���� � �������� ���������������
                $this->schedule_model->delete($schedule_id);           
                
                $name='info_ok';
                $data['info'] = '���� ���������';
                $this->display_lib->admin_info_page($data,$name);
            }
        }
    }
}
?>