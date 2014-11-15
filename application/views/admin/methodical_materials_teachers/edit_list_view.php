<div id="content">
<div id="left">
<h2>Вибір методичного матеріалу вчителя для редагування</h2>
<table class="admin_wrap">
    <tr>
        <th>ID</th>
        <th>Назва матеріалу</th>
        <th>Клас</th>
        <th>Предмет</th>
        <th>Автор</th>
        <th>Дата добавлення</th>
        <th>Дата оновлення</th>
    </tr>
    <?php foreach ($teachers_list as $item):?>
    <tr>
        <td><a href = "<?=base_url()."methodical_materials/edit_teachers/$item[methodical_materials_teachers_id]";?>"><?="$item[methodical_materials_teachers_id]";?></a></td>
        <td><a href = "<?=base_url()."methodical_materials/edit_teachers/$item[methodical_materials_teachers_id]";?>"><?="$item[title]";?></a></td>
        <td><a href = "<?=base_url()."methodical_materials/edit_teachers/$item[methodical_materials_teachers_id]";?>"><?="$item[class_id]";?></a></td>
        <td><a href = "<?=base_url()."methodical_materials/edit_teachers/$item[methodical_materials_teachers_id]";?>"><?="$item[subject_id]";?></a></td>
        <td><a href = "<?=base_url()."methodical_materials/edit_teachers/$item[methodical_materials_teachers_id]";?>"><?="$item[author_id]";?></a></td>
        <td><a href = "<?=base_url()."methodical_materials/edit_teachers/$item[methodical_materials_teachers_id]";?>"><?="$item[date]";?></a></td>
        <td><a href = "<?=base_url()."methodical_materials/edit_teachers/$item[methodical_materials_teachers_id]";?>"><?="$item[date_update]";?></a></td>
    </tr>
    <?php endforeach;?>
</table>
<div style="clear: both;">&nbsp;</div>
<div id="pagination"><p><?=$page_nav;?></p></div>
<a href="#top">Наверх</a>
</div>