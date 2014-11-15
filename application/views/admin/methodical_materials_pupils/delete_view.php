<div id="content">
<div id="left">
<h2>Видалення методичного матеріалу учня</h2>

<form action = "<?=base_url();?>methodical_materials/delete_pupils" method="post">  
<table class="admin_wrap">
    <tr>
        <th></th>
        <th>ID</th>
        <th>Назва матеріалу</th>
        <th>Клас</th>
        <th>Предмет</th>
        <th>Автор</th>
        <th>Дата добавлення</th>
        <th>Дата оновлення</th>
    </tr>
    <?php foreach ($pupils_list as $item): ?>
    <tr>
    <?="<td><input name='methodical_materials_pupils_id' type='radio' value='$item[methodical_materials_pupils_id]'></td>
        <td>$item[methodical_materials_pupils_id]</td>
        <td>$item[title]</td>
        <td>$item[class_id]</td>
        <td>$item[subject_id]</td>
        <td>$item[author_id]</td>
        <td>$item[date]</td>
        <td>$item[date_update]</td>";?>
    </tr>
    <?php endforeach;?>
</table>

<p><input type = "submit" name = "delete_button" id = "delete_button" value = "" /></p>

</form>

<div style="clear: both;">&nbsp;</div>
<div id="pagination"><p><?=$page_nav;?></p></div>
<a href="#top">Наверх</a>

</div>