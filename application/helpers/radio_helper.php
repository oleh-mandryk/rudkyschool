<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Проставляємо checked
function populate($names,$section_name)
{
    if ($names['section'] == $section_name)
    {
        echo 'checked';        
    }
}

function populate_publish($names_pub,$publish_name)
{
    if ($names_pub['publish_id'] == $publish_name)
    {
        echo 'checked';        
    }
}

function populate_select($names_sel,$select_name)
{
    if ($names_sel == $select_name)
    {
        echo 'selected="selected"';        
    }
    
}

function populate_select_admin($names_sel,$select_name)
{
    if ($names_sel['day_id'] == $select_name)
    {
        echo 'selected="selected"';        
    }
    
}

function populate_select_admin_pup($names_sel,$select_name)
{
    if ($names_sel['class_id'] == $select_name)
    {
        echo 'selected="selected"';        
    }
    
}

function populate_select_methodical($names_sel,$select_name)
{
    if ($names_sel == $select_name)
    {
        echo 'selected="selected"';        
    }
    
}

function populate_select_methodical_1($names_sel_1,$select_name)
{
    if ($names_sel_1 == $select_name)
    {
        echo 'selected="selected"';        
    }
    
}

function populate_select_photo($names_sel,$select_name)
{
    if ($names_sel['photogallery_section'] == $select_name)
    {
        echo 'selected="selected"';        
    }
    
}
?>