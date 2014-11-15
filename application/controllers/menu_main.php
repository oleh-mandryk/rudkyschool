<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Menu_main extends CI_Controller
{
   public function index()
    {
        redirect (base_url());
    }

    //���������� ������ ������ ����
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
            $this->form_validation->set_rules($this->menu_main_model->add_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                $add_ok = $this->input->post('name_item_id');
                $add_mas = $this->menu_main_model->get_admin($add_ok);
                
                if (empty($add_mas['name_item_id']))
                {
                    //��������� ������� ���������� ������ ������ ����
                    $this->menu_main_model->add();
                    
                    $name = 'info_ok';
                    $data['info'] = '����� ����� ��������� ���� ����������';
                    $this->display_lib->admin_info_page($data,$name);
                }  
                else
                {
                    $name = 'info_error';
                    $data['info'] = '����� ����� ��������� ���� ��� ����';
                    $this->display_lib->admin_info_page($data,$name);
                }
            }
            else
            {
                $name = 'menu_main/add';
                //�������� ������ ����� data ���, �� ����� ������� ������� admin_page 
                $this->display_lib->admin_page($data,$name);           
            }
        }
              
        //���� �� ��������� ������ "������", �������� ������� �����
        else
        {                      
            $name = 'menu_main/add';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //����������� (���� ������ ������ ���� ��� ������)  
    public function edit_list()
    {
        $this->auth_lib->check_admin();
        
        //����� � ���� �������� ���� ��� ������ ������
        
        $data = array('menu_main_list' => $this->menu_main_model->get_other_admin());
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        $name = 'menu_main/edit_list';
    
        $this->display_lib->admin_page($data,$name);
    }
    
    //����������� (����� �� ����������, �� �������� � ����)
    public function edit($name_item_id = '')
    {
        $this->auth_lib->check_admin();
        
        $this->load->helper('tinymce');
        $this->load->helper('radio');
        
        //������� ����� ������ ������ ���� (row_array) ��� ����������� � ���� ����������� 
        $data=array();
        $data = $this->menu_main_model->get_admin($name_item_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
           
        //���� ����� ������
        if (empty($data['name_item_id']))
        {
            $name = 'info_error';
            $data['info'] = '������ ������ ��������� ���� �� ����';       
            $this->display_lib->admin_info_page($data,$name);               
        }
        else
        {
            $data['names_pub'] = $this->menu_main_model->get_publish_values($name_item_id);
            $name = 'menu_main/edit';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //��������� ������ ���� � ��� �����)
    public function update($name_item_id = '')
    {
        $this->auth_lib->check_admin();
        
        $this->load->helper('tinymce'); 
        
        $data=array();
        $data = $this->menu_main_model->get_admin($name_item_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //���� ��������� ������ "�������"
        if (isset($_POST['update_button']))
        {
            $this->form_validation->set_rules($this->menu_main_model->update_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                //��������� ����� ����
                $this->menu_main_model->update($name_item_id);
                
                $name='info_ok';
                $data['info'] = '����� ��������� ���� ���������';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                //������� ����� � ������ ������ ���� ��� ���������� � ���� ����� (�, �� �� ������� ��������, �������� � ����, � �, �� ������� - � ������ POST)
                $data = $this->menu_main_model->get_admin($name_item_id);
                $data['menu_top'] = $this->menu_top_model->get_other();
                $data['menu_main'] = $this->menu_main_model->get_other();
                $data['img_footer'] = $this->img_footer_model->get_other();
               
                $name = 'menu_main/edit';
                $this->display_lib->admin_page($data,$name);
            }
        }
        //�� ��������� ������ "�������"
        else
        {
            $name='info_error';
            $data['info'] = '����� ��������� ���� �� ��� ���������, ������ �� �� ��������� ������ "�������"';
            $this->display_lib->admin_info_page($data,$name);
        }
    }
    
    //��������� ������ ����
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
            //����� � ���� �������� ����
            $data['menu_main_list'] = $this->menu_main_model->get_other_admin();
            $name = 'menu_main/delete';
    
            $this->display_lib->admin_page($data,$name);
        }
        
        //���� ��������� ������ "��������"
        else
        {
            //��� �� �������� ����� ����
            if ( ! isset($_POST['name_item_id']))
            {
                $name='info_error';
                $data['info'] = '�� �������� ����� ��������� ���� ��� ���������';
                $this->display_lib->admin_info_page($data,$name);                      
            }
    
            //� �������� ����� ��������� ���� ��� ���������
            else 
            {
                //�������� ������������� ������ ��������� ���� � ������ POST
                $name_item_id = $this->input->post('name_item_id');
                
                //��������� ����� ��������� ���� � �������� ���������������
                $this->menu_main_model->delete($name_item_id);                         
                
                $name='info_ok';
                $data['info'] = '����� ��������� ���� ���������';                  
                $this->display_lib->admin_info_page($data,$name);            
            }
        }
    }
    

}
?>