<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Photogallery_photos extends CI_Controller
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

//���������� ���� ����������
    public function add()
    {
        $this->auth_lib->check_admin();
        
        $this->load->helper('tinymce');
        
        $data = array();
        
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        $data['all_photogallery_sections'] = $this->photogallery_sections_model->get_other();
            
        $this->load->library('upload');
        $this->load->library('upload_lib');
        $this->load->library('image_lib');
        $this->load->library('image_small_lib');
    
        //������������ 
        $settings = $this->upload_lib->get_settings('photogallery');
                   
        //����������� ������������
        $this->upload->initialize($settings);
            
        //���� ��������� ������ "������"  
        if (isset($_POST['add_button']))
        {
            
            
            $this->form_validation->set_rules($this->photogallery_photos_model->add_rules);
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
                        $width =100;
                        $height =75;
                    }
                    else
                    {
                        $width =75;
                        $height =100;
                        
                    }
                    $settings = $this->image_small_lib->get_settings('photogallery',$url_small, $width, $height);
                
                    //����������� ������������
                    $this->image_lib->initialize($settings);
                    $this->image_lib->resize();
                
                    //������ ���� ����������
                    $this->photogallery_photos_model->add_photo('photogallery',$img_name);
                    
                    if ( ! $this->image_lib->resize())
                    {
                        $name = 'info_error';
                        $data['info'] = $this->image_lib->display_errors();
                        $this->display_lib->admin_info_page($data,$name);  
                    }
                    else
                    {
                        $data['menu_top'] = $this->menu_top_model->get_other();
                        $data['menu_main'] = $this->menu_main_model->get_other();
                        $data['img_footer'] = $this->img_footer_model->get_other();
                        $add_button = $this->input->post('add_button');
                        unset($add_button);
                        $name = 'info_ok';
                        $data['info'] = '���������� ���������';
                        $this->display_lib->admin_info_page($data,$name);
                    }
                }
           }
           else
           {
           $name = 'photogallery_photos/add';
           //�������� ������ ����� data ���, �� ����� ������� ������� admin_page 
           $this->display_lib->admin_page($data,$name); 			
           }
        }
          
        //���� �� ��������� ������ "������", �������� ������� �����
        else
        {
            $name = 'photogallery_photos/add';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //����������� ���������� (���� ������ ���������� ��� ������)  
    public function edit_list($start_from = 0)
    {
        $this->auth_lib->check_admin();
        
        $data = array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        $this->load->library('pagination');
        $this->load->library('pagination_lib');
        
        //������ ��������� ����� ���������� �� �������
        $limit = $this->config->item('admin_per_page');
        
        //������ �������� ������� ����������
        $total = $this->photogallery_photos_model->count_all(); 
        
        //������������ (��� ���� ��������, ��'� ��� ���������� �� base_url, ��, ���������)
        $settings = $this->pagination_lib->get_settings('photogallery_edit_list','',$total,$limit);
        
        //����������� ������������
        $this->pagination->initialize($settings);      
        
        //������ ����������
        $data['photogallery_photos_list'] = $this->photogallery_photos_model->get_other_pagination_admin($limit,$start_from); 
        
        //������ pagination   
        $data['page_nav'] = $this->pagination->create_links();
        
        $name = 'photogallery_photos/edit_list';
        $this->display_lib->admin_page($data,$name);
    }
    
    //����������� (����� �� ����������, �� �������� � ����)
    public function edit($photogallery_photo_id = '')
    {
        $this->auth_lib->check_admin();
        
        $this->load->helper('tinymce');
        $this->load->helper('radio');
        
        //������� ����� ���� ���������� (row_array) ��� ����������� � ���� ����������� 
        $data=array();
        $data = $this->photogallery_photos_model->get_admin($photogallery_photo_id);
        $data['all_photogallery_sections'] = $this->photogallery_sections_model->get_other();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
           
        //���� ����� ������
        if (empty($data['photogallery_photo_id']))
        {
            $name = 'info_error';
            $data['info'] = '���� ���������� �� ����';       
            $this->display_lib->admin_info_page($data,$name);               
        }
        else
        {
            $data['names_pub'] = $this->photogallery_photos_model->get_publish_values($photogallery_photo_id);
            $data['names_sel'] = $this->photogallery_photos_model->get_section_values($photogallery_photo_id);
            $name = 'photogallery_photos/edit';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //��������� ���������� � ��� �����)
    public function update($photogallery_photo_id = '')
    {
        $this->auth_lib->check_admin();
        
        $data=array();
        $data = $this->photogallery_photos_model->get_admin($photogallery_photo_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //���� ��������� ������ "�������"
        if (isset($_POST['update_button']))
        {
            $this->form_validation->set_rules($this->photogallery_photos_model->update_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                //��������� ����������
                $this->photogallery_photos_model->update($photogallery_photo_id);
                
                $name='info_ok';
                $data['info'] = '���������� ��������';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                //������� ����� � ������ ���������� ��� ���������� � ���� ����� (�, �� �� ������� ��������, �������� � ����, � �, �� ������� - � ������ POST)
                $data = $this->photogallery_photos_model->get_admin($photogallery_photo_id);
                $data['menu_top'] = $this->menu_top_model->get_other();
                $data['menu_main'] = $this->menu_main_model->get_other();
                $data['img_footer'] = $this->img_footer_model->get_other();
               
                $name = 'photogallery_photos/edit';
                $this->display_lib->admin_page($data,$name);
            }
        }
        //�� ��������� ������ "�������"
        else
        {
            $name='info_error';
            $data['info'] = '���������� �� ���� ��������, ������ �� �� ��������� ������ "�������"';
            $this->display_lib->admin_info_page($data,$name);
        }
    }
    
    //��������� ����������
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
          
            //������ �������� ������� ����������
            $total = $this->photogallery_photos_model->count_all();        
          
            //������������ (��� ���� ��������, ��'� ��� ���������� �� base_url, ��, ���������)
            $settings = $this->pagination_lib->get_settings('photogallery_delete','',$total,$limit);
                    
            //����������� ������������
            $this->pagination->initialize($settings);            
            
            //������ ����������, �������� �������� �� pagination   
            $data['photogallery_list'] = $this->photogallery_photos_model->get_other_pagination_admin($limit,$start_from); 
            
            //������ pagination
            $data['page_nav'] = $this->pagination->create_links(); 
            $name = 'photogallery_photos/delete';    
            
            $this->display_lib->admin_page($data,$name);
        }
        
        //���� ������ "��������" ���������
        else
        {
            //��� �� ������� ����������
            if ( ! isset($_POST['photogallery_photo_id']))
            {
                $data['info'] = '�� ������� ���������� ��� ���������';
                $name='info_error';
                $this->display_lib->admin_info_page($data,$name);        
            }
    
            //������� ���������� ��� ���������
            else 
            {  
                //�������� ������������� ���������� � ������� POST
                $photogallery_photo_id = $this->input->post('photogallery_photo_id');
                $data_del = $this->photogallery_photos_model->get($photogallery_photo_id);
                if (empty($data_del))
                {
                    $data['info'] = '���������� ��������';
                    $name='info_ok';
                    $this->display_lib->admin_info_page($data,$name);
                }
                else
                {
                    //��������� ���������� � �����
                    $img_del_small = $data_del['url_small_img'];
                    $img_del_big = $data_del['url_big_img'];
                    unlink('./'.$img_del_small);
                    unlink('./'.$img_del_big);
                }
                //��������� ����������
                $this->photogallery_photos_model->delete($photogallery_photo_id);           
                $data['info'] = '���������� ��������';
                $name='info_ok';
                $this->display_lib->admin_info_page($data,$name);
            }
        }
    }
}
?>