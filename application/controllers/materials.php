<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Materials extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        redirect (base_url());
    }
    
    public function show($material_id)
    {
        $this->load->library('captcha_lib'); 
        
        //������� ��������, �� ������ � ������ �������
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
        
        //�������� � ���� �� ��������� �� �����������
        $data['questions_vote_all']= $this->ques_model->get_other();
        
        //�������� � ���� �� ������ ��� �����������
        $data['options_vote_all']= $this->options_model->get_other();
        
        //�������� � ���� ������ ������� ��������
        $data['update_materias']= $this->materials_model->update_materias();
        
        //����� �� ���� �������;
        $data['main_info'] = $this->materials_model->get($material_id);
                                
        //���� ����� ������
        if (empty($data['main_info']))
        {
            $data['title_info'] = '������������ �����������';
            $data['info'] = '������ �������� �� ����';
            $name = 'info_error';
            $this->display_lib->user_info_page($data,$name);
        }
        else
        {
            //������� ����� ��� ��������� ���� count_views (������� ����� ������ �������� +1)
            $counter_data = array('count_views' => $data['main_info']['count_views'] + 1);
            
            //��������� ������� ���������, ��� ����� �������� ��������� � ���
            $this->materials_model->update_counter($material_id,$counter_data);
                                   
            $name = 'materials/content';
            $this->display_lib->user_page($data,$name);
        }
    }
    
    //��������� ��������
    public function add()
    {
        $this->auth_lib->check_admin();
        
        $this->load->helper('tinymce');
        $this->load->model('sections_model');
        
        $data = array();
        $data['all_sections'] = $this->sections_model->get_other_admin();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
    
        $this->load->library('upload');
        $this->load->library('upload_lib');
        $this->load->library('image_lib');
        $this->load->library('image_small_lib');
    
        //������������
        $settings = $this->upload_lib->get_settings('mini_icon');
        
        //����������� ������������
        $this->upload->initialize($settings);
        
        //���� ��������� ������ "������"
        if (isset($_POST['add_button']))
        {
            $this->form_validation->set_rules($this->materials_model->add_rules);
            if ($this->form_validation->run() == TRUE)
            {
                if ( ! $this->upload->do_upload())
   	            {
   	                $name='info_error';
   	                $data['info'] = $this->upload->display_errors();
                    $this->display_lib->admin_info_page($data,$name);    
                }
                else
                {
                    $data = array('upload_data' => $this->upload->data());
                    $url_small = $data ['upload_data']['full_path'];
                    $img_name = $data ['upload_data']['file_name'];
                    $width = 35;
                    $height = 35;
                    $settings = $this->image_small_lib->get_settings('mini_icon',$url_small, $width, $height);
                    
                    //����������� ������������
                    $this->image_lib->initialize($settings);
                    $this->image_lib->resize();
                    
                    //���������� ����� �������
                    $this->materials_model->add_photo('mini_icon',$img_name);
                    if ( ! $this->image_lib->resize())
                    {
                        $data['menu_top'] = $this->menu_top_model->get_other();
                        $data['menu_main'] = $this->menu_main_model->get_other();
                        $data['img_footer'] = $this->img_footer_model->get_other();
                        
                        $name='info_error';
                        $data['info'] = $this->image_lib->display_errors();
                        $this->display_lib->admin_info_page($data,$name);  
                    }
                    else
                    {
                        unlink($url_small);
                        
                        $data['menu_top'] = $this->menu_top_model->get_other();
                        $data['menu_main'] = $this->menu_main_model->get_other();
                        $data['img_footer'] = $this->img_footer_model->get_other();
                        
                        $name='info_ok';
                        $data['info'] = '������� ����������';
                        $this->display_lib->admin_info_page($data,$name);
                    }
                }
            }
            else
            {
                $name = 'materials/add';
                $this->display_lib->admin_page($data,$name);
            }
        }  
        //���� �� ��������� ������ "������", �������� ������� �����
        else
        {   
            $name = 'materials/add';
            $this->display_lib->admin_page($data,$name);            
        }
    }
    
    //����������� �������� (���� ������ �������� ��� ������)  
    public function edit_list($start_from = 0)
    {
        $this->auth_lib->check_admin();
        
        $data = array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        $this->load->library('pagination');
        $this->load->library('pagination_lib');
        
        //������ ��������� ����� �������� �� �������
        $limit = $this->config->item('admin_per_page');
        
        //������ �������� ������� ��������
        $total = $this->materials_model->count_all(); 
        
        //������������ (��� ���� ��������, ��'� ��� ���������� �� base_url, ��, ���������)
        $settings = $this->pagination_lib->get_settings('material_edit_list','',$total,$limit);
        
        //����������� ������������
        $this->pagination->initialize($settings);      
        
        //������ ��������
        $data['materials_list'] = $this->materials_model->get_other_pagination_admin($limit,$start_from); 
        
        //������ pagination   
        $data['page_nav'] = $this->pagination->create_links();
        
        $name = 'materials/edit_list';
        $this->display_lib->admin_page($data,$name);
    }
    
    //����������� ��������
    public function edit($material_id = '')
    {
        $this->auth_lib->check_admin();
        
        $this->load->model('sections_model');
        $this->load->helper('tinymce');
        $this->load->helper('radio');    
        
        //������� ����� ������ �������� ��� ����������� � ���� �����������
        $data = array();
        
        $data = $this->materials_model->get_admin($material_id);
        $data['all_sections'] = $this->sections_model->get_other();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //���� ����� �������
        if (empty($data['material_id']))
        {
            $name='info_error';
            $data['info'] = '������ �������� �� ����';
            $this->display_lib->admin_info_page($data,$name);
        }
        else
        {   
            $data['names'] = $this->materials_model->get_section_values($material_id);
            $data['names_pub'] = $this->materials_model->get_publish_values($material_id);
            $name = 'materials/edit';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //��������� ��������
    public function update($material_id = '')
    {
        $this->auth_lib->check_admin(); 
        
        $this->load->model('sections_model');
        $this->load->helper('radio');
        $this->load->helper('tinymce');
        
        $data = array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //���� ��������� ������ "�������"
        if (isset($_POST['update_button']))
        {
            $this->form_validation->set_rules($this->materials_model->update_rules);
            if ($this->form_validation->run() == TRUE)
            {
                //��������� �������
                $this->materials_model->update($material_id);
                
                $name='info_ok';
                $data['info'] = '������� ���������';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                //������� ����� � ������ ��� ������� ��� ���������� � ���� �����
                $data = $this->materials_model->get_admin($material_id);
                $data['all_sections'] = $this->sections_model->get_other_admin();
                $data['menu_top'] = $this->menu_top_model->get_other();
                $data['menu_main'] = $this->menu_main_model->get_other();
                $data['img_footer'] = $this->img_footer_model->get_other();
                $data['names'] = $this->materials_model->get_section_values($material_id); 
                $data['names_pub'] = $this->materials_model->get_publish_values($material_id);                             
                
                $name = 'materials/edit';
                $this->display_lib->admin_page($data,$name);
            }
        }
        //�� ��������� ������ "�������"
        else
        {
            $name='info_error';
            $data['info'] = '������� �� ��� ���������, ������ �� �� ��������� ������ "�������"';
            $this->display_lib->admin_info_page($data,$name);
        }
    }
    
    //��������� ��������
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
            //������ ��������� ����� �������� �� ������� 
            $limit = $this->config->item('admin_per_page');
            
            //������ �������� ������� ��������
            $total = $this->materials_model->count_all();
            
            //������������ (��� ���� ��������, ��'� ��� ���������� �� base_url, ��, ���������)
            $settings = $this->pagination_lib->get_settings('material_delete','',$total,$limit);
            
            //����������� ������������
            $this->pagination->initialize($settings);            
        
            //������ ��������, �������� �������� �� pagination   
            $data['materials_list'] = $this->materials_model->get_other_pagination_admin($limit,$start_from); 
            
            //������ pagination
            $data['page_nav'] = $this->pagination->create_links(); 
            
            $name = 'materials/delete';    
            $this->display_lib->admin_page($data,$name);
        }
        //���� ������ "��������" ���������
        else
        {
            //��� �� �������� �������
            if ( ! isset($_POST['material_id']))
            {
                $name='info_error';
                $data['info'] = '�� �������� ������� ��� ���������';
                $this->display_lib->admin_info_page($data,$name);        
            }
            //�������� �������
            else 
            {
                $material_id = $this->input->post('material_id');
                $data_del = $this->materials_model->get_admin($material_id);
                if (empty($data_del))
                {
                    $name='info_ok';
                    $data['info'] = '���������� ��������';
                    $this->display_lib->admin_info_page($data, $name);
                }
                else
                {
                    //��������� ���������� � �����
                    $img_del_small = $data_del['small_img_url'];
                    unlink('./'.$img_del_small);
                }
                
                //��������� ������� �� ������� ���������������
                $this->materials_model->delete($material_id);
                
                $name='info_ok';
                $data['info'] = '������� ���������';
                $this->display_lib->admin_info_page($data,$name);
            }
        }
    }
}
?>