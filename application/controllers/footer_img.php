<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Footer_img extends CI_Controller
{
    public function index()
    {
        redirect (base_url());
    }

    //���������� ������ ���������� � �����
    public function add()
    {
        $this->auth_lib->check_admin();
        
        $data = array();
        
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
                          
        $this->load->library('upload');
        $this->load->library('upload_lib');
        $this->load->library('image_lib');
        $this->load->library('image_small_lib');
    
        //������������ 
        $settings = $this->upload_lib->get_settings('img_footer');
                   
        //����������� ������������
        $this->upload->initialize($settings);
            
        //���� ��������� ������ "������"  
        if (isset($_POST['add_button']))
        {
            $this->form_validation->set_rules($this->img_footer_model->add_rules);
            if ($this->form_validation->run() == TRUE)
            {
                if ( ! $this->upload->do_upload())
                {
                    $name = 'info_error';
                    $data['info'] = $this->upload->display_errors();
                    $this->display_lib->admin_info_page($data,$name );
                }
                else
                {
        			$data = array('upload_data' => $this->upload->data());
        			
                    $url_small = $data ['upload_data']['full_path'];
                    $width = $data ['upload_data']['image_width'];
                    $height = $data ['upload_data']['image_height'];
                    $img_name = $data ['upload_data']['file_name'];
                    
                    if ($width>$height)
                    {
                        $width =70;
                        $height =31;
                    }
                    else
                    {
                        $width =31;
                        $height =70;
                        
                    }
                    $settings = $this->image_small_lib->get_settings('img_footer',$url_small, $width, $height);
                
                    //����������� ������������
                    $this->image_lib->initialize($settings);
                    $this->image_lib->resize();
                
                    //������ ���� ���������� ��� ������
                    $this->img_footer_model->add_photo('img_footer',$img_name);
                    
                    if ( ! $this->image_lib->resize())
                    {
                        $name = 'info_error';
                        $data['info'] = $this->image_lib->display_errors();
                        $this->display_lib->admin_info_page($data,$name);  
                    }
                    else
                    {
                        unlink($url_small);
                        $data['menu_top'] = $this->menu_top_model->get_other();
                        $data['menu_main'] = $this->menu_main_model->get_other();
                        $data['img_footer'] = $this->img_footer_model->get_other();
                        
                        $name = 'info_ok';
                        $data['info'] = '���������� ��� ������ ���������';
                        $this->display_lib->admin_info_page($data,$name);
                    }
                }
           }
           else
           {
               $name = 'footer_img/add';
               //�������� ������ ����� data ���, �� ����� ������� ������� admin_page 
               $this->display_lib->admin_page($data,$name); 			
           }
        }
          
        //���� �� ��������� ������ "������", �������� ������� �����
        else
        {
            $name = 'footer_img/add';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //����������� ��������� ��� ������ (���� ������ ��������� ��� ������ ��� ������)  
    public function edit_list($start_from = 0)
    {
        $this->auth_lib->check_admin();
        
        $data = array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        $this->load->library('pagination');
        $this->load->library('pagination_lib');
        
        //������ ��������� ����� ��������� ��� ������ �� �������
        $limit = $this->config->item('admin_per_page');
        
        //������ �������� ������� ��������� ��� ������
        $total = $this->img_footer_model->count_all(); 
        
        //������������ (��� ���� ��������, ��'� ��� ���������� �� base_url, ��, ���������)
        $settings = $this->pagination_lib->get_settings('footer_edit_list','',$total,$limit);
        
        //����������� ������������
        $this->pagination->initialize($settings);      
        
        //������ ��������� ��� ������
        $data['footer_list'] = $this->img_footer_model->get_other_pagination_admin($limit,$start_from); 
        
        //������ pagination   
        $data['page_nav'] = $this->pagination->create_links();
        
        $name = 'footer_img/edit_list';
        $this->display_lib->admin_page($data,$name);
    }
    
    //����������� (����� �� ����������, �� �������� � ����)
    public function edit($img_footer_id = '')
    {
        $this->auth_lib->check_admin();
        
        $this->load->helper('radio');
        
        //������� ����� ������ ���������� (row_array) ��� ����������� � ���� ����������� 
        $data=array();
        $data = $this->img_footer_model->get_admin($img_footer_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
           
        //���� ����� ������
        if (empty($data['img_footer_id']))
        {
            $name = 'info_error';
            $data['info'] = '������ ���������� ��� ������ �� ����';       
            $this->display_lib->admin_info_page($data,$name);               
        }
        else
        {
            $data['names_pub'] = $this->img_footer_model->get_publish_values($img_footer_id);
            $name = 'footer_img/edit';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //��������� ���������� ��� ������ � ��� �����)
    public function update($img_footer_id = '')
    {
        $this->auth_lib->check_admin();
        
        $data=array();
        $data = $this->img_footer_model->get_admin($img_footer_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //���� ��������� ������ "�������"
        if (isset($_POST['update_button']))
        {
            $this->form_validation->set_rules($this->img_footer_model->update_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                //��������� ���������� ��� ������
                $this->img_footer_model->update($img_footer_id);
                
                $name='info_ok';
                $data['info'] = '���������� ��� ������ ��������';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                //������� ����� � ������ ���������� ��� ������ ��� ���������� � ���� ����� (�, �� �� ������� ��������, �������� � ����, � �, �� ������� - � ������ POST)
                $data = $this->img_footer_model->get_admin($img_footer_id);
                $data['menu_top'] = $this->menu_top_model->get_other();
                $data['menu_main'] = $this->menu_main_model->get_other();
                $data['img_footer'] = $this->img_footer_model->get_other();
               
                $name = 'footer_img/edit';
                $this->display_lib->admin_page($data,$name);
            }
        }
        //�� ��������� ������ "�������"
        else
        {
            $name='info_error';
            $data['info'] = '���������� ��� ������ �� ���� ��������, ������ �� �� ��������� ������ "�������"';
            $this->display_lib->admin_info_page($data,$name);
        }
    }
    
    //��������� ���������� ��� ������
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
            //������ ��������� ����� ��������� ��� ������ �� �������  
            $limit = $this->config->item('admin_per_page');
          
            //������ �������� ������� ��������� ��� ������
            $total = $this->img_footer_model->count_all();        
          
            //������������ (��� ���� ��������, ��'� ��� ���������� �� base_url, ��, ���������)
            $settings = $this->pagination_lib->get_settings('footer_delete','',$total,$limit);
                    
            //����������� ������������
            $this->pagination->initialize($settings);            
            
            //������ ��������� ��� ������, �������� �������� �� pagination   
            $data['footer_list'] = $this->img_footer_model->get_other_pagination_admin($limit,$start_from); 
            
            //������ pagination
            $data['page_nav'] = $this->pagination->create_links(); 
            $name = 'footer_img/delete';    
            
            $this->display_lib->admin_page($data,$name);
        }
        
        //���� ������ "��������" ���������
        else
        {
            //��� �� ������� ���������� ������
            if ( ! isset($_POST['img_footer_id']))
            {
                $data['info'] = '�� ������� ���������� ������ ��� ���������';
                $name='info_error';
                $this->display_lib->admin_info_page($data,$name);        
            }
    
            //������� ���������� ������ ��� ���������
            else 
            {  
                //�������� ������������� ���������� � ������� POST
                $img_footer_id = $this->input->post('img_footer_id');
                $data_del = $this->img_footer_model->get($img_footer_id);
                if (empty($data_del))
                {
                    $data['info'] = '���������� ��� ������ ��������';
                    $name='info_ok';
                    $this->display_lib->admin_info_page($data,$name);
                }
                else
                {
                    //��������� ���������� ��� ������ � �����
                    $img_del = $data_del['img_url'];
                    unlink('./'.$img_del);
                    
                }
                //��������� ���������� ��� ������
                $this->img_footer_model->delete($img_footer_id);           
                $data['info'] = '���������� ��� ������ ��������';
                $name='info_ok';
                $this->display_lib->admin_info_page($data,$name);
            }
        }
    }
}
?>