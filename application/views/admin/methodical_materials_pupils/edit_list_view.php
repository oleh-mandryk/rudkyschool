<div id="content">
<div id="left">
<h2>���� ����������� �������� ���� ��� �����������</h2>
<table class="admin_wrap">
    <tr>
        <th>ID</th>
        <th>����� ��������</th>
        <th>����</th>
        <th>�������</th>
        <th>�����</th>
        <th>���� ����������</th>
        <th>���� ���������</th>
    </tr>
    <?php foreach ($pupils_list as $item):?>
    <tr>
        <td><a href = "<?=base_url()."methodical_materials/edit_pupils/$item[methodical_materials_pupils_id]";?>"><?="$item[methodical_materials_pupils_id]";?></a></td>
        <td><a href = "<?=base_url()."methodical_materials/edit_pupils/$item[methodical_materials_pupils_id]";?>"><?="$item[title]";?></a></td>
        <td><a href = "<?=base_url()."methodical_materials/edit_pupils/$item[methodical_materials_pupils_id]";?>"><?="$item[class_id]";?></a></td>
        <td><a href = "<?=base_url()."methodical_materials/edit_pupils/$item[methodical_materials_pupils_id]";?>"><?="$item[subject_id]";?></a></td>
        <td><a href = "<?=base_url()."methodical_materials/edit_pupils/$item[methodical_materials_pupils_id]";?>"><?="$item[author_id]";?></a></td>
        <td><a href = "<?=base_url()."methodical_materials/edit_pupils/$item[methodical_materials_pupils_id]";?>"><?="$item[date]";?></a></td>
        <td><a href = "<?=base_url()."methodical_materials/edit_pupils/$item[methodical_materials_pupils_id]";?>"><?="$item[date_update]";?></a></td>
    </tr>
    <?php endforeach;?>
</table>
<div style="clear: both;">&nbsp;</div>
<div id="pagination"><p><?=$page_nav;?></p></div>
<a href="#top">������</a>
</div>