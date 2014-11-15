<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Photogallery_sections extends CI_Controller
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
    
    //start_from - � ��� ���������� �������� ���� ��� ����� �������
    //������� �� ��������� pagination
    public function show($photogallery_section_id,$start_from = 0)
    {
        $this->load->library('pagination');
        $this->load->library('pagination_lib');
        
        $data = array();
        
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
        $data['main_info'] = $this->photogallery_sections_model->get($photogallery_section_id);
        
        //�������� � ���� �� ��������� �� �����������
        $data['questions_vote_all']= $this->ques_model->get_other(); 
        
        //�������� � ���� �� ������ ��� �����������
        $data['options_vote_all']= $this->options_model->get_other();
        
        //�������� � ���� ������ ������� ��������
        $data['update_materias']= $this->materials_model->update_materias();
                              
        //���� ����� ������
        if (empty($data['main_info']))
        {
            $data['info'] = '���� ������� �� ����';
            $data['title_info'] = '������������ �����������';
            $name = 'info';
            $this->display_lib->user_info_page($data,$name);
        }
        else
        {
            //������ ��������� ������� ���������� �� ������� �� �������
            $limit = $this->config->item('user_per_photo');
            
            //������� �������� ������� ���� � ��������� �������
            $total = $this->photogallery_photos_model->count_by($photogallery_section_id);
            
            //������������ (��� ���� ��������, ��'� ��� ����������� �� base_url, �����, ���������)
            $settings = $this->pagination_lib->get_settings('photogallery_section',$photogallery_section_id,$total,$limit);
            
            //����������� ���������
            $this->pagination->initialize($settings);
            
            //�������� ������ ��������, �� �������� �������� � �����������
            $data['photogallery_photos_list'] = $this->photogallery_photos_model->get_by($photogallery_section_id,$limit,$start_from);
            
            //�������� ��� ������ ����������� ��������
            $data['page_nav'] = $this->pagination->create_links();
            $name = 'photogallery/photogallery_sections';
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
            $this->form_validation->set_rules($this->photogallery_sections_model->add_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                $add_ok = $this->input->post('photogallery_section_id');
                $add_mas = $this->photogallery_sections_model->get_admin($add_ok);
                
                if (empty($add_mas['photogallery_section_id']))
                {
                    //��������� ������� ���������� �������
                    $this->photogallery_sections_model->add();
                    
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
                $name = 'photogallery_sections/add';
                //�������� ������ ����� data ���, �� ����� ������� ������� admin_page 
                $this->display_lib->admin_page($data,$name);           
            }
        }
              
        //���� �� ��������� ������ "������", �������� ������� �����
        else
        {                      
            $name = 'photogallery_sections/add';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //����������� (���� ������ �������� ��� ������)  
    public function edit_list()
    {
        $this->auth_lib->check_admin();
        
        //����� � ���� ���������� ��� ������ ������
        
        $data = array('photogallery_sections_list' => $this->photogallery_sections_model->get_other_admin());
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        $name = 'photogallery_sections/edit_list';
    
        $this->display_lib->admin_page($data,$name);
    }
    
    //����������� (����� �� ����������, �� �������� � ����)
    public function edit($photogallery_section_id = '')
    {
        $this->auth_lib->check_admin();
        
        $this->load->helper('tinymce');
        $this->load->helper('radio');
        
        //������� ����� ���� ������� (row_array) ��� ����������� � ���� ����������� 
        $data=array();
        $data = $this->photogallery_sections_model->get_admin($photogallery_section_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
           
        //���� ����� ������
        if (empty($data['photogallery_section_id']))
        {
            $name = 'info_error';
            $data['info'] = '���� ������� �� ����';       
            $this->display_lib->admin_info_page($data,$name);               
        }
        else
        {
            $data['names_pub'] = $this->photogallery_sections_model->get_publish_values($photogallery_section_id);
            $name = 'photogallery_sections/edit';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //��������� ������� � ��� �����)
    public function update($photogallery_section_id = '')
    {
        $this->auth_lib->check_admin();
        
        $data=array();
        $data = $this->photogallery_sections_model->get_admin($photogallery_section_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //���� ��������� ������ "�������"
        if (isset($_POST['update_button']))
        {
            $this->form_validation->set_rules($this->photogallery_sections_model->update_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                //��������� ��������
                $this->photogallery_sections_model->update($photogallery_section_id);
                
                $name='info_ok';
                $data['info'] = '�������� ��������';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                //������� ����� � ������ ������� ��� ���������� � ���� ����� (�, �� �� ������� ��������, �������� � ����, � �, �� ������� - � ������ POST)
                $data = $this->photogallery_sections_model->get_admin($photogallery_section_id);
                $data['menu_top'] = $this->menu_top_model->get_other();
                $data['menu_main'] = $this->menu_main_model->get_other();
                $data['img_footer'] = $this->img_footer_model->get_other();
               
                $name = 'photogallery_sections/edit';
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
            $data['photogallery_sections_list'] = $this->photogallery_sections_model->get_other_admin();
            $name = 'photogallery_sections/delete';
    
            $this->display_lib->admin_page($data,$name);
        }
        
        //���� ��������� ������ "��������"
        else
        {
            //��� �� ������� ��������
            if ( ! isset($_POST['photogallery_section_id']))
            {
                $name='info_error';
                $data['info'] = '�� ������� �������� ��� ���������';
                $this->display_lib->admin_info_page($data,$name);                      
            }
    
            //� ������� �������
            else 
            {
                //�������� ������������� ������� � ������ POST
                $photogallery_section_id = $this->input->post('photogallery_section_id');
                
                //��������� ������� � �������� ���������������
                $this->photogallery_sections_model->delete($photogallery_section_id);                         
                
                $name='info_ok';
                $data['info'] = '�������� ��������';                  
                $this->display_lib->admin_info_page($data,$name);            
            }
        }
    }




}
?>