<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Winged_phrases extends CI_Controller
{
    public function index()
    {
       redirect (base_url());
    }
    
    //��������� ������� �����
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
            $this->form_validation->set_rules($this->winged_phrases_model->add_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                //��������� ������� ���������� ������� �����
                $this->winged_phrases_model->add();
                $name = 'info_ok';
                $data['info'] = '������� ����� ���������';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                $name = 'winged_phrases/add';
                //�������� ������ ����� data ���, �� ����� ������� ������� admin_page 
                $this->display_lib->admin_page($data,$name);           
            }
        }
              
        //���� �� ��������� ������ "������", �������� ������� �����
        else
        {                      
            $name = 'winged_phrases/add';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //����������� ������� ����� (���� ������ �������� ���� ��� ������)  
    public function edit_list($start_from = 0)
    {
        $this->auth_lib->check_admin();
        
        $data = array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        $this->load->library('pagination');
        $this->load->library('pagination_lib');
        
        //������ ��������� ����� �������� ���� �� �������
        $limit = $this->config->item('admin_per_page');
        
        //������ �������� ������� �������� ����
        $total = $this->winged_phrases_model->count_all(); 
        
        //������������ (��� ���� ��������, ��'� ��� ���������� �� base_url, ��, ���������)
        $settings = $this->pagination_lib->get_settings('winged_phrases_edit_list','',$total,$limit);
        
        //����������� ������������
        $this->pagination->initialize($settings);      
        
        //������ �������� ����
        $data['winged_phrases_list'] = $this->winged_phrases_model->get_other_pagination_admin($limit,$start_from); 
        
        //������ pagination   
        $data['page_nav'] = $this->pagination->create_links();
        
        $name = 'winged_phrases/edit_list';
        $this->display_lib->admin_page($data,$name);
    }
    
    //����������� ������� �����
    public function edit($winged_phrases_id = '')
    {
        $this->auth_lib->check_admin();
        
        $this->load->helper('tinymce');
        $this->load->helper('radio');    
        
        //������� ����� ���� ������� ����� ��� ����������� � ���� �����������
        $data = array();
        
        $data = $this->winged_phrases_model->get_admin($winged_phrases_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //���� ����� �������
        if (empty($data['winged_phrases_id']))
        {
            $name='info_error';
            $data['info'] = '���� ������� ����� �� ����';
            $this->display_lib->admin_info_page($data,$name);
        }
        else
        {   
            $data['names_pub'] = $this->winged_phrases_model->get_publish_values($winged_phrases_id);
            $name = 'winged_phrases/edit';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //��������� ������� �����
    public function update($winged_phrases_id = '')
    {
        $this->auth_lib->check_admin(); 
        
        $this->load->helper('radio');
        $this->load->helper('tinymce');
        
        $data = array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //���� ��������� ������ "�������"
        if (isset($_POST['update_button']))
        {
            $this->form_validation->set_rules($this->winged_phrases_model->update_rules);
            if ($this->form_validation->run() == TRUE)
            {
                //��������� ������� �����
                $this->winged_phrases_model->update($winged_phrases_id);
                
                $name='info_ok';
                $data['info'] = '������� ����� ��������';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                //������� ����� � ������ ��� ������� ����� ��� ���������� � ���� �����
                $data = $this->winged_phrases_model->get_admin($winged_phrases_id);
                $data['menu_top'] = $this->menu_top_model->get_other();
                $data['menu_main'] = $this->menu_main_model->get_other();
                $data['img_footer'] = $this->img_footer_model->get_other();
                $data['names_pub'] = $this->winged_phrases_model->get_publish_values($winged_phrases_id);                             
                
                $name = 'winged_phrases/edit';
                $this->display_lib->admin_page($data,$name);
            }
        }
        //�� ��������� ������ "�������"
        else
        {
            $name='info_error';
            $data['info'] = '������� ����� �� ���� ��������, ������ �� �� ��������� ������ "�������"';
            $this->display_lib->admin_info_page($data,$name);
        }
    }
    
    //��������� ������� �����
    public function delete($start_from = 0)
    {
        $this->auth_lib->check_admin();
        
        $this->load->library('pagination');
        $this->load->library('pagination_lib');
        
        $data = array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //���� �� ��������� ������ "��������"
        if ( ! isset($_POST['delete_button']))
        {
            //������ ��������� ����� �������� ���� �� ������� 
            $limit = $this->config->item('admin_per_page');
            
            //������ �������� ������� �������� ����
            $total = $this->winged_phrases_model->count_all();
            
            //������������ (��� ���� ��������, ��'� ��� ���������� �� base_url, ��, ���������)
            $settings = $this->pagination_lib->get_settings('winged_phrases_delete','',$total,$limit);
            
            //����������� ������������
            $this->pagination->initialize($settings);            
        
            //������ �������� ����, �������� �������� �� pagination   
            $data['winged_phrases_list'] = $this->winged_phrases_model->get_other_pagination_admin($limit,$start_from); 
            
            //������ pagination
            $data['page_nav'] = $this->pagination->create_links(); 
            
            $name = 'winged_phrases/delete';    
            $this->display_lib->admin_page($data,$name);
        }
        //���� ������ "��������" ���������
        else
        {
            //��� �� ������� ������� �����
            if ( ! isset($_POST['winged_phrases_id']))
            {
                $name='info_error';
                $data['info'] = '�� ������� ������� ����� ��� ���������';
                $this->display_lib->admin_info_page($data,$name);        
            }
            //������� ������� �����
            else 
            {
                //�������� ������������� ������� ����� � ������ POST
                $winged_phrases_id = $this->input->post('winged_phrases_id');
                
                //��������� ������� ����� � �������� ���������������
                $this->winged_phrases_model->delete($winged_phrases_id);           
                
                $name='info_ok';
                $data['info'] = '������� ����� ��������';
                $this->display_lib->admin_info_page($data,$name);
            }
        }
    }
}
?>