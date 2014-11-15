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
    
    //start_from - � ����� �������� �������� ���� ��� ����� �������
    //������� �� ��������� pagination
    public function show($section_id,$start_from = 0)
    {
        $this->load->library('pagination');
        $this->load->library('pagination_lib');
        
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
        
        //����� �� ���� �������;
        $data['main_info'] = $this->sections_model->get($section_id);
        
        //�������� � ���� �� ��������� �� �����������
        $data['questions_vote_all']= $this->ques_model->get_other(); 
        
        //�������� � ���� �� ������ ��� �����������
        $data['options_vote_all']= $this->options_model->get_other();
        
        //�������� � ���� ������ ������� ��������
        $data['update_materias']= $this->materials_model->update_materias();
        
        //�������� � ���� ������ ������� ��������
        $data['update_materias']= $this->materials_model->update_materias();
                              
        //���� ����� ������
        if (empty($data['main_info']))
        {
            $data['info'] = '���� ������� �� ����';
            $data['title_info'] = '������������ �����������';
            $name = 'info_error';
            $this->display_lib->user_info_page($data,$name);
        }
        else
        {
            //������ ��������� ������� �������� �� �������
            $limit = $this->config->item('user_per_page');
            
            //������� �������� ������� �������� � ��������� �������
            $total = $this->materials_model->count_by($section_id);
            
            //������������ (��� ���� ��������, ��'� ��� ����������� �� base_url, �����, ���������)
            $settings = $this->pagination_lib->get_settings('section',$section_id,$total,$limit);
            
            //����������� ���������
            $this->pagination->initialize($settings);
            
            //�������� ������ ��������, �� �������� �������� � �����������
            $data['materials_list'] = $this->materials_model->get_by($section_id,$limit,$start_from);
            
            //�������� ��� ������ ����������� ��������
            $data['page_nav'] = $this->pagination->create_links();
            $name = 'sections/content';
            $this->display_lib->user_page($data,$name);
        }
    }
    
    //���������� ���� �������
    public function add()
    {
        $this->auth_lib->check_admin();
        
        $this->load->helper('tinymce');
        
        $data=array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //���� ��������� ������ "������"  
        if (isset($_POST['add_button']))      
        {
            $this->form_validation->set_rules($this->sections_model->add_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                $add_ok = $this->input->post('section_id');
                $add_mas = $this->sections_model->get_admin($add_ok);
                
                if (empty($add_mas['section_id']))
                {
                    //��������� ������� ���������� �������
                    $this->sections_model->add();
                    
                    $name = 'info_ok';
                    $data['info'] = '�������� ���������';
                    $this->display_lib->admin_info_page($data,$name);
                }  
                else
                {
                    $name = 'info_error';
                    $data['info'] = '���� �������� ��� ����';
                    $this->display_lib->admin_info_page($data,$name);
                }
            }
            else
            {
                $name = 'sections/add';
                //�������� ������ ����� data ���, �� ����� ������� ������� admin_page 
                $this->display_lib->admin_page($data,$name);           
            }
        }
              
        //���� �� ��������� ������ "������", �������� ������� �����
        else
        {                      
            $name = 'sections/add';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //����������� (���� ������ �������� ��� ������)  
    public function edit_list()
    {
        $this->auth_lib->check_admin();
        
        //����� � ���� ���������� ��� ������ ������
        
        $data = array('sections_list' => $this->sections_model->get_other_admin());
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        $name = 'sections/edit_list';
    
        $this->display_lib->admin_page($data,$name);
    }
    
    //����������� (����� �� ����������, �� �������� � ����)
    public function edit($section_id = '')
    {
        $this->auth_lib->check_admin();
        
        $this->load->helper('tinymce');
        $this->load->helper('radio');
        
        //������� ����� ���� ������� (row_array) ��� ����������� � ���� ����������� 
        $data=array();
        $data = $this->sections_model->get_admin($section_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
           
        //���� ����� ������
        if (empty($data['section_id']))
        {
            $name = 'info_error';
            $data['info'] = '���� ������� �� ����';       
            $this->display_lib->admin_info_page($data,$name);               
        }
        else
        {
            $data['names_pub'] = $this->sections_model->get_publish_values($section_id);
            $name = 'sections/edit';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //��������� ������� � ��� �����)
    public function update($section_id = '')
    {
        $this->auth_lib->check_admin();
        
        //$this->load->helper('tinymce'); 
        
        $data=array();
        $data = $this->sections_model->get_admin($section_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //���� ��������� ������ "�������"
        if (isset($_POST['update_button']))
        {
            $this->form_validation->set_rules($this->sections_model->update_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                //��������� ��������
                $this->sections_model->update($section_id);
                
                $name='info_ok';
                $data['info'] = '�������� ��������';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                //������� ����� � ������ ������� ��� ���������� � ���� ����� (�, �� �� ������� ��������, �������� � ����, � �, �� ������� - � ������ POST)
                $data = $this->sections_model->get_admin($section_id);
                $data['menu_top'] = $this->menu_top_model->get_other();
                $data['menu_main'] = $this->menu_main_model->get_other();
                $data['img_footer'] = $this->img_footer_model->get_other();
               
                $name = 'sections/edit';
                $this->display_lib->admin_page($data,$name);
            }
        }
        //�� ��������� ������ "�������"
        else
        {
            $name='info_error';
            $data['info'] = '�������� �� ���� ��������, ������ �� �� ��������� ������ "�������"';
            $this->display_lib->admin_info_page($data,$name);
        }
    }
    
    //��������� �������
    public function delete()
    {
        $this->auth_lib->check_admin();
        
        $data=array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //���� �� ��������� ������ "��������"
        if ( ! isset($_POST['delete_button']))
        {
            //����� � ���� ���������
            $data['sections_list'] = $this->sections_model->get_other_admin();
            $name = 'sections/delete';
    
            $this->display_lib->admin_page($data,$name);
        }
        
        //���� ��������� ������ "��������"
        else
        {
            //��� �� ������� ��������
            if ( ! isset($_POST['section_id']))
            {
                $name='info_error';
                $data['info'] = '�� ������� �������� ��� ���������';
                $this->display_lib->admin_info_page($data,$name);                      
            }
    
            //� ������� �������
            else 
            {
                //�������� ������������� ������� � ������ POST
                $section_id = $this->input->post('section_id');
                
                //��������� ������� � �������� ���������������
                $this->sections_model->delete($section_id);                         
                
                $name='info_ok';
                $data['info'] = '�������� ��������';                  
                $this->display_lib->admin_info_page($data,$name);            
            }
        }
    }




}
?>