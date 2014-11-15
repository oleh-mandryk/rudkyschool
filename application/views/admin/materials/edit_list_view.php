<div id="content">
<div id="left">
<h2>Вибір матеріалу для редагування</h2>
<table class="admin_wrap">
    <tr>
        <th>ID</th>
        <th>Назва матеріалу</th>
        <th>Автор</th>
        <th>Категорія</th>
        <th>Добавлено</th>
        <th>Оновлено</th>
    </tr>
    <?php foreach ($materials_list as $item):?>
    <tr>
        <td><a href = "<?=base_url()."materials/edit/$item[material_id]";?>"><?="$item[material_id]";?></a></td>
        <td><a href = "<?=base_url()."materials/edit/$item[material_id]";?>"><?="$item[title]";?></a></td>
        <td><a href = "<?=base_url()."materials/edit/$item[material_id]";?>"><?="$item[author]";?></a></td>
        <td><a href = "<?=base_url()."materials/edit/$item[material_id]";?>"><?="$item[section]";?></a></td>
        <td><a href = "<?=base_url()."materials/edit/$item[material_id]";?>"><?="$item[date]";?></a></td>
        <td><a href = "<?=base_url()."materials/edit/$item[material_id]";?>"><?="$item[date_update]";?></a></td>
    </tr>
    <?php endforeach;?>
</table> 

<div style="clear: both;">&nbsp;</div>
<div id="pagination"><p><?=$page_nav;?></p></div>
<a href="#top">Наверх</a>

</div>