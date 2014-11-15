<div id="content">
<div id="left">
<h2>Видалення матеріалу</h2>

<form action = "<?=base_url();?>materials/delete" method="post">  
<table class="admin_wrap">
    <tr>
        <th></th>
        <th>ID</th>
        <th>Назва матеріалу</th>
        <th>Автор</th>
        <th>Категорія</th>
        <th>Добавлено</th>
        <th>Оновлено</th>
    </tr>
    <?php foreach ($materials_list as $item): ?>
    <tr>
    <?="<td><input name='material_id' type='radio' value='$item[material_id]'></td>
        <td>$item[material_id]</td>
        <td>$item[title]</td>
        <td>$item[author]</td>
        <td>$item[section]</td>
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