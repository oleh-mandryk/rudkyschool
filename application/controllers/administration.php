<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Administration extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $this->auth_lib->check_admin();
        
        $this->load->model('pages_model');
        $this->load->model('sections_model');
        
        $data = array();
        
        //������ ��������
        $data['materials_count'] = $this->materials_model->count_all();
        
        //������ �������
        $data['pages_count'] = $this->pages_model->count_all(); 
        
        //������ ��������
        $data['sections_count']    = $this->sections_model->count_all();
        
        //����� � �������� �������� (������� ����);
        $data['menu_main'] = $this->menu_main_model->get_other();
        
        //����� � �������� ��������� ����;
        $data['menu_top'] = $this->menu_top_model->get_other();
        
        //�������� ��� ������
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //�������� � ���� ������ ������� ��������
        $data['update_materias']= $this->materials_model->update_materias();
                      
        $name = 'main_admin';
        $this->display_lib->admin_page($data,$name);
    }
    
    public function preferences()
    {
        $this->auth_lib->check_admin();
        
        $data = array();
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //���� ��������� ������ "�������"
        if (isset($_POST['update_button']))
        {
            //������������ ������ ��������
            $this->form_validation->set_rules($this->administration_model->preferences_rules);
            
            //���� �������� ������ ��������
            if ($this->form_validation->run() == TRUE)
            {
                //�������� � ����� data ������� � ����� ����
                $data_admin = array();
                $data_admin['user_per_page']   = $this->input->post('user_per_page');
                $data_admin['admin_per_page']  = $this->input->post('admin_per_page');
                $data_admin['admin_login']     = $this->input->post('admin_login');
                $data_admin['admin_pass']      = $this->input->post('admin_pass');
                $data_admin['search_per_page'] = $this->input->post('search_per_page');
                $data_admin['user_per_photo'] = $this->input->post('user_per_photo');
                
                foreach ($data_admin as $key => $value)
                {    
                    //��������� � ���� ��� ����� ���������      
                    $this->db->where('pref_id',$key);
                    
                    //������ �������� ��� update - ����� (���� ���� ���������� �������� ����� $value)
                    $this->db->update('preferences',array('value' => $value));
                }
                
                $name='info_ok';
                $data['info'] = '������������ �������';
                $this->display_lib->admin_info_page($data,$name);
            }
            
            //���� �������� �� ��������
            else
            {
                $name = 'preferences';
                $this->display_lib->admin_page($data,$name);
            }
        }
        
        //������ "�������" �� ���������
        else
        {
            $name = 'preferences';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    public function login()
    {
        //������������ ������ ��������
        $this->form_validation->set_rules($this->administration_model->login_rules);

        //���� �������� �� ��������
        if ($this->form_validation->run() == FALSE)
        {
            $this->display_lib->login_page();
        }

        //���� �������� ��������, ���������� �����
        else
        {
            $this->auth_lib->do_login($this->input->post('login'),$this->input->post('pass'));
        }
    }
    
    public function logout()
    {
        //����������, �� ��� ��������� ����
        $this->auth_lib->check_admin();//��� �������� �� ��� ����'������ � �������
        $this->auth_lib->do_logout();
    }
  
    public function search($start_from = 0)
    {
        $this->load->library('pagination');
        $this->load->library('pagination_lib');
        
        //��� ����������� ���������� ������ � ������(view) � ������������ ������
        $this->load->helper('text'); 

        // ��������� ��������, ������ � ����� ������
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
        
        //������ ������� ���������� ������ �� �������
        $limit = $this->config->item('search_per_page');
        
        //���� ��������� ������ "�����"
        if (isset($_POST['search_button']))
        {  
            //������������ ������� ��������
            $this->form_validation->set_rules($this->administration_model->search_rules);
            $val_res = $this->form_validation->run();

            // ������� ����� � ������� ����������
            $ses_search = array();
            $ses_search['val_passed'] = ''; // �� ������� ��������
            $ses_search['search_query'] = ''; // ��������� �����
            $this->session->set_userdata($ses_search);//�������� ����
        
            //���� �������� �������� 
            if ($val_res == TRUE)
            {
                //TRUE - ��������� �� xss-�����            
                $search = $this->input->post('search',TRUE);
            
                //���������� ��������� ������� � html-�������, ��� �������� ����� �� ����� ������� html
                $search = htmlspecialchars($search); 
                
                //�������� ���� ���� ����������� ��������
                $ses_search = array();    
                
                //�������� �������� ������ ��� ���������� ������       
                $ses_search['val_passed'] = 'yes'; 
                
                //��������� �����
                $ses_search['search_query'] = $search;  
                
                //�������� ����
                $this->session->set_userdata($ses_search);
                
                //����� �� ��������� ��������� � ��������
                $mpsearch_results = $this->administration_model->materials_pages_search($search,$limit,$start_from);
                       
                //���� ����� ������
                if (empty ($mpsearch_results))
                    {                      
                        $data['info'] = '���������� �� ������ ������ �� ��������';                             
                        $data['title_info']='���������� ������';
                        $name = 'info_error';
                        $this->display_lib->user_info_page($data,$name);
                    }
                //����� ��� ���������
                else
                {   
                    //������ �������� ������� �������, ��  ������ ��������� �����
                    $total = $mpsearch_results['counter']; 
                
                    //������������ (��� ���� ��������, ��'� ��� ���������� �� base_url, ������, ���������)
                    $settings = $this->pagination_lib->get_settings('search','',$total,$limit);
                    
                    //�������� ������������
                    $this->pagination->initialize($settings);
                    
                    //����� �� ��������� ��������� � ��������
                    $data['mpsearch_results'] = $mpsearch_results;
                                    
                    //��������� pagination         
                    $data['page_nav'] = $this->pagination->create_links();
                     
                    $name = 'admin/search';
                    $data['title_info']='���������� ������';
                    $this->display_lib->user_info_page($data,$name);            
                }
            }
            //���� �������� �� ��������
            else
            {
                $data['info'] = '���������� ��������� ������';                              
                $data['title_info']='���������� ��������� ������';
                $name = 'info_error';                  
                $this->display_lib->user_info_page($data,$name);
            }
        }
        //���� �� ������ ������ "�����"
        else
        {
        //��� � ��� ���������� ���������� ��� ������ �������� ��������
        if ($this->session->userdata('val_passed') === 'yes')
        {
            //�������� � ����� search ����� ���������� ������, �� ���������� � ���
            $search = $this->session->userdata('search_query');

            //����� �� ��������� ��������� � ��������
            $mpsearch_results = $this->administration_model->materials_pages_search($search,$limit,$start_from);
                        
            // ���� ����� ������
            if (empty ($mpsearch_results))
            {                       
                $data['info'] = '���������� �� ������ ������ �� ��������';                             
                $data['title_info']='���������� ������';
                $name = 'info';
                $this->display_lib->user_info_page($data,$name);            
            }
            // ����� ��� ���������
            else
            {
                //������ �������� ������� �������, �� ������ ��������� �����
                $total = $mpsearch_results['counter'];
                
                //������������ (��� ���� ��������, ��'� ��� ���������� �� base_url, ������, ���������)
                $settings = $this->pagination_lib->get_settings('search','',$total,$limit);

                //�������� ������������
                $this->pagination->initialize($settings);
                
                //����� �� ��������� ��������� � ��������
                $data['mpsearch_results']  = $mpsearch_results;
                                               
                //��������� pagination
                $data['page_nav'] = $this->pagination->create_links(); 
                $data['title_info']='���������� ������';
                $name = 'admin/search';           
                $this->display_lib->user_info_page($data,$name);
            }
        }
        // � � ������ ��� ���������� �� �������� ����������� ���������
        else
        {
            $data['info'] = '���������� ��������� ������';                          
            $data['title_info']='���������� ��������� ������';
            $name = 'info_error';
            $this->display_lib->user_info_page($data,$name);
        }
        }
    }
    
}
?>