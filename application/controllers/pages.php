<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pages extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pages_model');
        //$this->load->library('breadcrumb_lib');
    }
    
    public function index()
    {
        redirect(base_url());
    }
    
    public function show($page_id)
    {
        //������� ����� ��� ����������� � ���;
        $data=array();
        
        //��������
        $data['calendar'] = $this->calendar->generate();
        
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
        
        //����� �� ���� �������;
        $data['main_info'] = $this->pages_model->get($page_id);
        
        //�������� � ���� �� ��������� �� �����������
        $data['questions_vote_all']= $this->ques_model->get_other();
        
        //�������� � ���� �� ������ ��� �����������
        $data['options_vote_all']= $this->options_model->get_other();
        
        //�������� � ���� ������ ������� ��������
        $data['update_materias']= $this->materials_model->update_materias();
        
        switch ($page_id)
        {
            //���� ������� "�������"
            case 'index':
            //���� ����� ������
            if (empty($data['main_info']))
            {
                $data['info'] = '���� ���� �������';
                $data['title_info'] = '������������ �����������';
                $name = 'info_error';
                $this->display_lib->user_info_page($data, $name);
            }
            else
            {
                $name = 'pages/mainpage';
                $this -> display_lib->user_page($data, $name);
            }
            break;
            
            //���� ������� "��������"
            case 'contact':
            $this->load->library('captcha_lib');
            
            //�� ��������� ������ "³��������"
            if(! isset($_POST['send_message']))
            {
            //�������� ��� ��������
            $data['imgcode'] = $this->captcha_lib->captcha_actions();
            $data['info'] = ''; //������������ �����������
            $name = 'pages/contact';
            $this->display_lib->user_page($data, $name);
            }
            
            //������ ������ "³��������"
            else
            {
                //������������ ������ ��������
                $this->form_validation->set_rules($this->pages_model->contact_rules);
                $val_res = $this->form_validation->run();
                
                //���� �������� ��������
                if ($val_res == TRUE)
                {
                    //�������� �������� ���� �����
                    $entered_captcha = $this->input->post('captcha');
                
                //���� ����� ������� - ����������� �����������
                if ($entered_captcha == $this->session->userdata('rnd_captcha'))
                {
                    $this->load->library('typography');
                    
                    //��'� ����������
                    $name = $this->input->post('name');
                    
                    //�������� ����������� email
                    $email = $this->input->post('email');
                    
                    //���� �����������, ������� �����������
                    $topic = $this->input->post('topic');
                    
                    //����� �����������
                    $text = $this->input->post('message');
                    
                    //������� ���� 70 ����� (��������� mail � PHP)
                    $text = wordwrap($text,70);
                    
                    //TRUE - ����� ���� �������� ����� ��� ���� �������� �� ��� �������� �����
                    $text = $this->typography->auto_typography($text, TRUE);
                    
                    //��������� html-���� ��� �������� �������
                    $text = strip_tags($text);
                    
                    //���� ������������� �����������
                    $address = "admin@vyshnya.lviv.ua";
                    
                    //���� �����������, �� ���� ������ ���������
                    $subject = "��������� �� ����� ����������� ��'���";
                    $message = "�������(��):$name\n����: $topic\n�����������:\n$text\nE-mail ����������: $email";
                    
                    //³���������� �����������
                    mail ($address,$subject,$message,"Content-type:text/plain;charset = windows-1251\r\n");
                    $data['info'] = '���� ����������� ����������. ���� ���� ������� ������, �� ��\'������ � ����
                    ���������� �����.';
                    $data['title_info'] = '���� ����������� ����������';
                    $name = 'info_ok';
                    $this->display_lib->user_info_page($data,$name);
                    }
                //���� ����� �� �������
                else
                {
                    //�������� ��� ��������
                    $data['imgcode'] = $this->captcha_lib->captcha_actions();
                    $data['info'] = '����������� ������ ����� � ��������';
                    $data['title_info'] = '����������� ������ ����� � ��������';
                    $name = 'pages/contact';
                    $this->display_lib->user_page($data,$name);
                    
                }
            }
            //���� �������� �� �������
            else
            {
            //�������� ��� ��������
            $data['imgcode'] = $this->captcha_lib->captcha_actions();
            $data['info'] ='';//������������ ����������
            $name = 'pages/contact';
            $this->display_lib->user_page($data,$name);
            }
        }
        break;
        
        //���� ������� "world_sites"
        case 'world_sites':
        $this->load->library('captcha_lib');
        
        //�� ��������� ������ "³��������"
        if(! isset($_POST['send_message']))
        {
        //�������� ��� ��������
        $data['imgcode'] = $this->captcha_lib->captcha_actions();
        $data['info'] = ''; //������������ �����������
        
        $name = 'pages/world_sites';
        $this->display_lib->user_page($data, $name);
        }
        
        //������ ������ "³��������"
        else
        {
            //������������ ������ ��������
            $this->form_validation->set_rules($this->pages_model->contact_rules);
            $val_res = $this->form_validation->run();
            
            //���� �������� ��������
            if ($val_res == TRUE)
            {
                //�������� �������� ���� �����
                $entered_captcha = $this->input->post('captcha');
            
            //���� ����� ������� - ����������� �����������
            if ($entered_captcha == $this->session->userdata('rnd_captcha'))
            {
                $this->load->library('typography');
                
                //��'� ����������
                $name = $this->input->post('name');
                
                //�������� ����������� email
                $email = $this->input->post('email');
                
                //���� �����������, ������� �����������
                $topic = $this->input->post('topic');
                
                //����� �����������
                $text = $this->input->post('message');
                
                //������� ���� 70 ����� (��������� mail � PHP)
                $text = wordwrap($text,70);
                
                //TRUE - ����� ���� �������� ����� ��� ���� �������� �� ��� �������� �����
                $text = $this->typography->auto_typography($text, TRUE);
                
                //��������� html-���� ��� �������� �������
                $text = strip_tags($text);
                
                //���� ������������� �����������
                $address = "oleh_mandryk@vyshnya.lviv.ua";
                
                //���� �����������, �� ���� ������ ���������
                $subject = "��������� �� ����� ����������� ��'���";
                $message = "�������(��):$name\n����: $topic\n�����������:\n$text\nE-mail ����������: $email";
                
                //³���������� �����������
                mail ($address,$subject,$message,"Content-type:text/plain;charset = windows-1251\r\n");
                $data['info'] = '���� ����������� ����������. ���� ���� ������� ������, �� ��\'������ � ����
                ���������� �����.';
                $data['title_info'] = '���� ����������� ����������';
                $name = 'info_ok';
                $this->display_lib->user_info_page($data,$name);
                }
            //���� ����� �� �������
            else
            {
                //�������� ��� ��������
                $data['imgcode'] = $this->captcha_lib->captcha_actions();
                $data['info'] = '����������� ������ ����� � ��������';
                $data['title_info'] = '����������� ������ ����� � ��������';
                $name = 'pages/world_sites';
                $this->display_lib->user_page($data,$name);
                
            }
        }
        //���� �������� �� �������
        else
        {
        //�������� ��� ��������
        $data['imgcode'] = $this->captcha_lib->captcha_actions();
        $data['info'] ='';//������������ ����������
        $name = 'pages/world_sites';
        $this->display_lib->user_page($data,$name);
        }
    }
    break;
            
            //���� ������� "����� �����"
            case 'map':
            //���� ����� ������
            if (empty($data['main_info']))
            {
                $data['info'] = '���� ���� �������';
                $data['title_info'] = '������������ �����������';
                $name = 'info_error';
                $this->display_lib->user_info_page($data, $name);
            }
            else
            {
                $data['all_materials'] = $this->materials_model->all_materials();
                $name = 'pages/map';
                $this -> display_lib->user_page($data, $name);
            }
            break;
            
            // ����-��� ���� �������
             default:
             //���� ����� ������
             if (empty($data['main_info']))
             {
                $data['info'] = '���� ���� �������';
                $data['title_info'] = '������������ �����������';
                $name = 'info_error';
                $this->display_lib->user_info_page($data, $name);
             }
             else
             {
                $name = 'pages/page';
                $this -> display_lib->user_page($data, $name);
                 
             }
             break;
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
            $this->form_validation->set_rules($this->pages_model->add_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                $add_ok = $this->input->post('page_id');
                $add_mas = $this->pages_model->get_admin($add_ok);
                
                if (empty($add_mas['page_id']))
                {
                    //��������� ������� ���������� �������
                    $this->pages_model->add();
                    
                    $name = 'info_ok';
                    $data['info'] = '������� ���������';
                    $this->display_lib->admin_info_page($data,$name);
                }  
                else
                {
                    $name = 'info_error';
                    $data['info'] = '���� ������� ��� ����';
                    $this->display_lib->admin_info_page($data,$name);
                }
            }
            else
            {
                $name = 'pages/add';
                //�������� ������ ����� data ���, �� ����� ������� ������� admin_page 
                $this->display_lib->admin_page($data,$name);           
            }
        }
              
        //���� �� ��������� ������ "������", �������� ������� �����
        else
        {                      
            $name = 'pages/add';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //����������� (���� ������ ������� ��� ������)  
    public function edit_list()
    {
        $this->auth_lib->check_admin();
        
        //����� � ���� ��������� ��� ������ ������
        
        $data = array('pages_list' => $this->pages_model->get_other_admin());
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        $name = 'pages/edit_list';
    
        $this->display_lib->admin_page($data,$name);
    }
    
    //����������� (����� �� ����������, �� �������� � ����)
    public function edit($page_id = '')
    {
        $this->auth_lib->check_admin();
        
        $this->load->helper('tinymce');
        $this->load->helper('radio');
        
        //������� ����� ���� ������� (row_array) ��� ����������� � ���� ����������� 
        $data=array();
        $data = $this->pages_model->get_admin($page_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
           
        //���� ����� ������
        if (empty($data['page_id']))
        {
            $name = 'info_error';
            $data['info_error'] = '���� ������� �� ����';       
            $this->display_lib->admin_info_page($data,$name);               
        }
        else
        {
            $data['names_pub'] = $this->pages_model->get_publish_values($page_id);
            $name = 'pages/edit';
            $this->display_lib->admin_page($data,$name);
        }
    }
    
    //��������� ������� � ��� �����)
    public function update($page_id = '')
    {
        $this->auth_lib->check_admin();
        
        $this->load->helper('tinymce'); 
        
        $data=array();
        $data = $this->pages_model->get_admin($page_id);
        $data['menu_top'] = $this->menu_top_model->get_other();
        $data['menu_main'] = $this->menu_main_model->get_other();
        $data['img_footer'] = $this->img_footer_model->get_other();
        
        //���� ��������� ������ "�������"
        if (isset($_POST['update_button']))
        {
            $this->form_validation->set_rules($this->pages_model->update_rules);
            
            if ($this->form_validation->run() == TRUE)
            {
                //��������� �������
                $this->pages_model->update($page_id);
                
                $name='info_ok';
                $data['info'] = '������� ��������';
                $this->display_lib->admin_info_page($data,$name);
            }
            else
            {
                //������� ����� � ������ ������� ��� ���������� � ���� ����� (�, �� �� ������� ��������, �������� � ����, � �, �� ������� - � ������ POST)
                $data = $this->pages_model->get_admin($page_id);
                $data['menu_top'] = $this->menu_top_model->get_other();
                $data['menu_main'] = $this->menu_main_model->get_other();
                $data['img_footer'] = $this->img_footer_model->get_other();
               
                $name = 'pages/edit';
                $this->display_lib->admin_page($data,$name);
            }
        }
        //�� ��������� ������ "�������"
        else
        {
            $name='info_error';
            $data['info'] = '������� �� ���� ��������, ������ �� �� ��������� ������ "�������"';
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
            $data['pages_list'] = $this->pages_model->get_other_admin();
            $name = 'pages/delete';
    
            $this->display_lib->admin_page($data,$name);
        }
        
        //���� ��������� ������ "��������"
        else
        {
            //��� �� ������� �������
            if ( ! isset($_POST['page_id']))
            {
                $name='info_error';
                $data['info'] = '�� ������� ������� ��� ���������';
                $this->display_lib->admin_info_page($data,$name);                      
            }
    
            //� ������� �������
            else 
            {
                //�������� ������������� ������� � ������ POST
                $page_id = $this->input->post('page_id');
                
                //��������� ������� � �������� ���������������
                $this->pages_model->delete($page_id);                         
                
                $name='info_ok';
                $data['info'] = '������� ��������';                  
                $this->display_lib->admin_info_page($data,$name);            
            }
        }
    }
}
?>