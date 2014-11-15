<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pagination_lib
{
    //id - ��� ���� ��������, name - ��� ����������� �� base_url(����� ��� ��������), ������, ���������
    public function get_settings($id,$name,$total,$limit)
    {
        $config = array();
        $config['total_rows'] = $total;
        $config['per_page'] = $limit;
        $config['first_link'] = '&laquo;�����';
        $config['last_link'] = '�������&raquo;';
        $config['next_link'] = '&raquo;';
        $config['prev_link'] = '&laquo;';
        
        // ���������� ��� ����� ����������
        $config['full_tag_open'] = '<ul id="pagination">';
        
        // ����������� ��� ����� ��������� 
        $config['full_tag_close'] = '</ul>';
        
        // ������ �������� ����������� ��� 
        $config['first_tag_open'] = '<li>'; 
        
        // ������ �������� ����������� ��� 
        $config['first_tag_close'] = '</li>';
        
        // ��������� �������� ����������� ��� 
        $config['last_tag_open'] = '<li>'; 
        
        // ��������� �������� ����������� ���
        $config['last_tag_close'] = '</li>'; 
        
        // ���������� �������� ����������� ���
        $config['prev_tag_open'] = '<li>';
        
        // ���������� �������� ����������� ��� 
        $config['prev_tag_close'] = '</li>';
        
        // ������� �������� ����������� ���
        $config['cur_tag_open'] = '<li class = "active">'; 
        
        // ������� �������� ����������� ���
        $config['cur_tag_close'] = '</li>';
            
        $config['num_tag_open'] = '<li>'; // �������� ������ ����������� ���
        $config['num_tag_close'] = '</li>'; // �������� ������ ����������� ���
        
        // ��������� �������� ����������� ���
        $config['next_tag_open'] = '<li>'; 
        
        // ��������� �������� ����������� ���
        $config['next_tag_close'] = '</li>';        
        
        switch($id)
        {
            //���� �������� ��� ��������
            case 'section':
                $config['base_url'] = base_url().'sections/show/'.$name;
                $config['uri_segment'] = 4;
                //ʳ������ "��������" ������ �� ����� �� �������
                $config['num_links'] = 2;
                return $config;
                break;
                
                //���� �������� ��� �������� ����������
            case 'photogallery_section':
                $config['base_url'] = base_url().'photogallery_sections/show/'.$name;
                $config['uri_segment'] = 4;
                //ʳ������ "��������" ������ �� ����� �� �������
                $config['num_links'] = 2;
                return $config;
                break;
            
            //���� �������� ��� ������
            case 'search':
                $config['base_url'] = base_url().'search/';
                $config['uri_segment'] = 2;
                $config['num_links'] = 2;
                return $config;
                break;
                
            //���� �������� ��� �������� (������ ��� ����������� � ������)
            case 'material_edit_list':
                $config['base_url'] = base_url().'materials/edit_list/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
               
            //���� �������� ��� �������� (������ ��� ��������� � ������)
            case 'material_delete':
                $config['base_url'] = base_url().'materials/delete/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
                
                //���� �������� ��� �������� ���� (������ ��� ����������� � ������)
            case 'winged_phrases_edit_list':
                $config['base_url'] = base_url().'winged_phrases/edit_list/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
                
                //���� �������� ��� �������� ���� (������ ��� ����������� � ������)
            case 'winged_phrases_delete':
                $config['base_url'] = base_url().'winged_phrases/delete/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
                
                //���� �������� ��� ������ ����� (������ ��� ����������� � ������)
            case 'i_wonder_edit_list':
                $config['base_url'] = base_url().'i_wonder/edit_list/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
                
                //���� �������� ��� ������ ����� (������ ��� ����������� � ������)
            case 'i_wonder_delete':
                $config['base_url'] = base_url().'i_wonder/delete/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
                
                //���� �������� ��� ������ ����� (������ ��� ����������� � ������)
            case 'schedule_edit_list':
                $config['base_url'] = base_url().'schedule/edit_list_schedule/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
                
                //���� �������� ��� ������ ����� (������ ��� ����������� � ������)
            case 'schedule_delete':
                $config['base_url'] = base_url().'schedule/delete_schedule/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
                
                //���� �������� ��� ���������� (������ ��� ����������� � ������)
            case 'photogallery_edit_list':
                $config['base_url'] = base_url().'photogallery_photos/edit_list/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
                
                //���� �������� ��� ���������� (������ ��� ����������� � ������)
            case 'photogallery_delete':
                $config['base_url'] = base_url().'photogallery_photos/delete/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
                
                //���� �������� ��� ��������� ������ (������ ��� ����������� � ������)
            case 'footer_edit_list':
                $config['base_url'] = base_url().'footer_img/edit_list/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
                
                //���� �������� ��� ��������� ������ (������ ��� ����������� � ������)
            case 'footer_delete':
                $config['base_url'] = base_url().'footer_img/delete/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
                
                //���� �������� ��� ���������� �������� ���� (������ ��� ����������� � ������)
            case 'pupils_edit_list':
                $config['base_url'] = base_url().'methodical_materials/edit_list_pupils/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
                
                //���� �������� ��� ���������� �������� ���� (������ ��� ����������� � ������)
            case 'pupils_delete':
                $config['base_url'] = base_url().'methodical_materials/delete_pupils/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
                
                //���� �������� ��� ���������� �������� ������� (������ ��� ����������� � ������)
            case 'teachers_edit_list':
                $config['base_url'] = base_url().'methodical_materials/edit_list_teachers/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
                
                //���� �������� ��� ���������� �������� ������� (������ ��� ����������� � ������)
            case 'teachers_delete':
                $config['base_url'] = base_url().'methodical_materials/delete_teachers/';
                $config['uri_segment'] = 3;
                $config['num_links'] = 2;
                return $config;
                break;
        }
    }
}
?>