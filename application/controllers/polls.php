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
        
            
        //������� ��������, �� ������ � ����-����� �������
        $data = array();
        
        //��������
        $data['calendar'] = $this->calendar->generate();
        
        //����� � �������� �������� (������� ����);
        $data['menu_main'] = $this->menu_main_model->get_other();
        
        //����� � �������� ��������� ����;
        $data['menu_top'] = $this->menu_top_model->get_other();
        
        //��������;
        $data['calendar'] = $this->calendar->generate();
        
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
        
        if (isset($_POST['result_button']))
        {
            
            $poll_id = $data['questions_vote_all'][0]['ques_id'];
            $data['count_votes'] = $this->votes_model->count_votes($poll_id);
            $data['showresults_all']= $this->votes_model->showresults($poll_id);
            $data['first_vote']= $this->votes_model->get_first_vote();
            $data['last_vote']= $this->votes_model->get_last_vote();
            $data['info_vote']='';
            $data['title_info']='���������� �����������';
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
                    $data['info_vote_ok']='������ �� ��� �����!';
                    $data['count_votes'] = $this->votes_model->count_votes($poll_id);
                    $data['showresults_all']= $this->votes_model->showresults($poll_id);
                    $data['first_vote']= $this->votes_model->get_first_vote();
                    $data['last_vote']= $this->votes_model->get_last_vote(); 
                    $name = 'admin/vote_ok';
                    $data['title_info']='���������� �����������';
                    $this->display_lib->user_info_page($data,$name);
                }
                else
                {
                    $data['info_vote']='�� ��� �������������!';
                
                $data['count_votes'] = $this->votes_model->count_votes($poll_id);
                $data['showresults_all']= $this->votes_model->showresults($poll_id);
                $data['first_vote']= $this->votes_model->get_first_vote();
                $data['last_vote']= $this->votes_model->get_last_vote(); 
                $name = 'admin/vote';
                $data['title_info']='���������� �����������';
                $this->display_lib->user_info_page($data,$name);
                }
            }
            else
            {
                $data['info_vote']='��� ���� �� ��� ���������, ����-�����, ��������� �� ���!'; 
                $data['count_votes'] = $this->votes_model->count_votes($poll_id);
                $data['showresults_all']= $this->votes_model->showresults($poll_id);
                $data['first_vote']= $this->votes_model->get_first_vote();
                $data['last_vote']= $this->votes_model->get_last_vote(); 
                $data['title_info']='���������� �����������';
                $name = 'admin/vote';
                $this->display_lib->user_info_page($data,$name);
            }
        }
    }
    
    //����������� (���� ������ �������� ��� ������)  
    public function edit_list_ques()
    {
        $this->auth_lib->check_admin();
        
        $this->load->model('ques_model');
        
        //����� � ���� ��������� ��� ������ ������
        
        $data = array('ques_list' => $this->ques_model->get_other_admin());
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        $name = 'ques/edit_list';
        
        $this->display_lib->admin_page($data,$name);
    }
    
    //����������� (����� �� ����������, �� �������� � ����)
    public function edit_ques($ques_id = '')
    {
        $this->auth_lib->check_admin();
                       
        //������� ����� ������ ��������� (row_array) ��� ����������� � ���� ����������� 
        $data=array();
        $data = $this->ques_model->get_admin($ques_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
           
        //���� ����� ������
        if (empty($data['ques_id']))
        {
            $name = 'info_error';
            $data['info'] = '������ ��������� ��� ����������� �� ����';       
            $this->display_lib->admin_info_page($data,$name);               
        }
        else
        {
            $name = 'ques/edit';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //��������� ��������� �� ����������� � ��� �����)
    public function update_ques($ques_id = '')
    {
        $this->auth_lib->check_admin();
        
        $data=array();
        $data = $this->ques_model->get_admin($ques_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //���� ��������� ������ "�������"
        if (isset($_POST['update_button']))
        {
            $this->form_validation->set_rules($this->ques_model->update_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                //��������� ��������� ��� �����������
                $this->ques_model->update($ques_id);
                
                $name='info_ok';
                $data['info'] = '��������� ��� ����������� ��������';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                //������� ����� � ������ ��������� ��� ���������� � ���� ����� (�, �� �� ������� ��������, �������� � ����, � �, �� ������� - � ������ POST)
                $data = $this->ques_model->get_admin($ques_id);
                $data['menu_top'] = $this->menu_top_model->get_other();
                $data['menu_main'] = $this->menu_main_model->get_other();
                $data['img_footer'] = $this->img_footer_model->get_other();
               
                $name = 'ques/edit';
                $this->display_lib->admin_page($data,$name);
            }
        }
        //�� ��������� ������ "�������"
        else
        {
            $name='info_error';
            $data['info'] = '��������� ��� ����������� �� ���� ��������, ������ �� �� ��������� ������ "�������"';
            $this->display_lib->admin_info_page($data,$name);
        }
    }
    
    //���������� ���� ������ ��� �����������
    public function add_options()
    {
        $this->auth_lib->check_admin();
        
        $data=array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //���� ��������� ������ "������"  
        if (isset($_POST['add_button']))      
        {
            $this->form_validation->set_rules($this->options_model->add_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                $add_ok = $this->input->post('option_id');
                $add_mas = $this->options_model->get_admin($add_ok);
                
                //��������� ������� ���������� ��������� ��� �����������
                $this->options_model->add();
                
                $name = 'info_ok';
                $data['info'] = '��������� ��� ����������� ���������';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                $name = 'options/add';
                //�������� ������ ����� data ���, �� ����� ������� ������� admin_page 
                $this->display_lib->admin_page($data,$name);           
            }
        }
              
        //���� �� ��������� ������ "������", �������� ������� �����
        else
        {                      
            $name = 'options/add';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //����������� (���� ������ �������� ��� ����������� ��� ������)  
    public function edit_list_options()
    {
        $this->auth_lib->check_admin();
        
        //����� � ���� ��������� ��� ����������� ��� ������ ������
        
        $data = array('options_list' => $this->options_model->get_other_admin());
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        $name = 'options/edit_list';
    
        $this->display_lib->admin_page($data,$name);
    }
    
    //����������� (����� �� ����������, �� �������� � ����)
    public function edit_options($option_id = '')
    {
        $this->auth_lib->check_admin();
        
        $this->load->helper('radio');
        
        //������� ����� ���� ������ ��� ����������� (row_array) ��� ����������� � ���� ����������� 
        $data=array();
        $data = $this->options_model->get_admin($option_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
           
        //���� ����� ������
        if (empty($data['option_id']))
        {
            $name = 'info_error';
            $data['info'] = '���� ������ ��� ����������� �� ����';       
            $this->display_lib->admin_info_page($data,$name);               
        }
        else
        {
            $data['names_pub'] = $this->options_model->get_publish_values($option_id);
            $name = 'options/edit';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //��������� ������ ��� ����������� � ��� �����)
    public function update_options($option_id = '')
    {
        $this->auth_lib->check_admin();
        
        $data=array();
        $data = $this->options_model->get_admin($option_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //���� ��������� ������ "�������"
        if (isset($_POST['update_button']))
        {
            $this->form_validation->set_rules($this->options_model->update_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                //��������� ������� ��� �����������
                $this->options_model->update($option_id);
                
                $name='info_ok';
                $data['info'] = '³������ ��� ����������� ��������';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                //������� ����� � ������ ������ ��� ���������� � ���� ����� (�, �� �� ������� ��������, �������� � ����, � �, �� ������� - � ������ POST)
                $data = $this->options_model->get_admin($option_id);
                $data['menu_top'] = $this->menu_top_model->get_other();
                $data['menu_main'] = $this->menu_main_model->get_other();
                $data['img_footer'] = $this->img_footer_model->get_other();
               
                $name = 'options/edit';
                $this->display_lib->admin_page($data,$name);
            }
        }
        //�� ��������� ������ "�������"
        else
        {
            $name='info_error';
            $data['info'] = '³������ ��� ����������� �� ���� ��������, ������ �� �� ��������� ������ "�������"';
            $this->display_lib->admin_info_page($data,$name);
        }
    }
    
    //��������� ������ ��� �����������
    public function delete_options()
    {
        $this->auth_lib->check_admin();
        
        $data=array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //���� �� ��������� ������ "��������"
        if ( ! isset($_POST['delete_button']))
        {
            //����� � ���� ��������� ��� �����������
            $data['options_list'] = $this->options_model->get_other_admin();
            $name = 'options/delete';
    
            $this->display_lib->admin_page($data,$name);
        }
        
        //���� ��������� ������ "��������"
        else
        {
            //��� �� ������� ������� ��� �����������
            if ( ! isset($_POST['option_id']))
            {
                $name='info_error';
                $data['info'] = '�� ������� ������� ��� ���������';
                $this->display_lib->admin_info_page($data,$name);                      
            }
    
            //� ������� ������� ��� �����������
            else 
            {
                //�������� ������������� ������ ��� ����������� � ������ POST
                $option_id = $this->input->post('option_id');
                
                //��������� ������� ��� ����������� � �������� ���������������
                $this->options_model->delete($option_id);                         
                
                $name='info_ok';
                $data['info'] = '³������ ��� ����������� ��������';                  
                $this->display_lib->admin_info_page($data,$name);            
            }
        }
    }
    
    //����������� (���� ������ ���������� ����������� ��� ������)  
    public function edit_list_votes()
    {
        $this->auth_lib->check_admin();
        
        $this->load->model('votes_model');
        
        //����� � ���� ������������ ����������� ��� ������ ������
        
        $data = array('votes_list' => $this->votes_model->get_other_admin());
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        $name = 'votes/edit_list';
    
        $this->display_lib->admin_page($data,$name);
    }
    
    //����������� (����� �� ����������, �� �������� � ����)
    public function edit_votes($vote_id = '')
    {
        $this->auth_lib->check_admin();
        
        $this->load->model('votes_model');
        $this->load->helper('radio');
        
        //������� ����� ������ ���������� ����������� (row_array) ��� ����������� � ���� ����������� 
        $data=array();
        $data = $this->votes_model->get_admin($vote_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
           
        //���� ����� ������
        if (empty($data['vote_id']))
        {
            $name = 'info_error';
            $data['info'] = '������ ���������� ����������� �� ����';       
            $this->display_lib->admin_info_page($data,$name);               
        }
        else
        {
            $data['names_pub'] = $this->votes_model->get_publish_values($vote_id);
            $name = 'votes/edit';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //��������� ���������� ����������� � ��� �����)
    public function update_votes($vote_id = '')
    {
        $this->auth_lib->check_admin();
        
        $this->load->model('votes_model');
        
        $data=array();
        $data = $this->votes_model->get_admin($vote_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //���� ��������� ������ "�������"
        if (isset($_POST['update_button']))
        {
            $this->form_validation->set_rules($this->votes_model->update_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                //��������� ��������� �����������
                $this->votes_model->update($vote_id);
                
                $name='info_ok';
                $data['info'] = '��������� ����������� ���������';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                //������� ����� � ������ ���������� ����������� ��� ���������� � ���� ����� (�, �� �� ������� ��������, �������� � ����, � �, �� ������� - � ������ POST)
                $data = $this->votes_model->get_admin($vote_id);
                $data['menu_top'] = $this->menu_top_model->get_other();
                $data['menu_main'] = $this->menu_main_model->get_other();
                $data['img_footer'] = $this->img_footer_model->get_other();
               
                $name = 'votes/edit';
                $this->display_lib->admin_page($data,$name);
            }
        }
        //�� ��������� ������ "�������"
        else
        {
            $name='info_error';
            $data['info'] = '��������� ����������� �� ��� ���������, ������ �� �� ��������� ������ "�������"';
            $this->display_lib->admin_info_page($data,$name);
        }
    }
    
    //��������� ���������� �����������
    public function delete_votes()
    {
        $this->auth_lib->check_admin();
        
        $this->load->model('votes_model');
        
        $data=array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //���� �� ��������� ������ "��������"
        if ( ! isset($_POST['delete_button']))
        {
            //����� � ���� ������������ �����������
            $data['votes_list'] = $this->votes_model->get_other_admin();
            $name = 'votes/delete';
    
            $this->display_lib->admin_page($data,$name);
        }
        
        //���� ��������� ������ "��������"
        else
        {
            //��� �� �������� ��������� �����������
            if ( ! isset($_POST['vote_id']))
            {
                $name='info_error';
                $data['info'] = '�� �������� ��������� ����������� ��� ���������';
                $this->display_lib->admin_info_page($data,$name);                      
            }
    
            //� �������� ��������� ����������� ��� ���������
            else 
            {
                //�������� ������������� ���������� ����������� � ������ POST
                $vote_id = $this->input->post('vote_id');
                
                //��������� ��������� ����������� � �������� ���������������
                $this->votes_model->delete($vote_id);                         
                
                $name='info_ok';
                $data['info'] = '��������� ����������� ���������';                  
                $this->display_lib->admin_info_page($data,$name);            
            }
        }
    }
}
?>