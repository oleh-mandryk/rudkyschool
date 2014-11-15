<div id="content">
<div id="left">
<h2>Вибір категорії для редагування</h2>
<table class="admin_wrap">
    <tr>
        <th>ID</th>
        <th>Назва категорії</th>
        <th>Кількість фото</th>
    </tr>
    <?php foreach ($photogallery_sections_list as $item):?>
    <tr>
        <td><a href = "<?=base_url()."photogallery_sections/edit/$item[photogallery_section_id]";?>"><?="$item[photogallery_section_id]";?></a></td>
        <td><a href = "<?=base_url()."photogallery_sections/edit/$item[photogallery_section_id]";?>"><?="$item[title]";?></a></td>
        <td><a href = "<?=base_url()."photogallery_sections/edit/$item[photogallery_section_id]";?>"><?="$item[count_photo]";?></a></td>
    </tr>
    <?php endforeach;?>
</table>
<div style="clear: both;">&nbsp;</div>
<a href="#top">Наверх</a>
</div>