<div id="content">
<div id="left">
<h2>Видалення категорії</h2>

<form action = "<?=base_url();?>photogallery_sections/delete" method="post">  
<table class="admin_wrap">
    <tr>
        <th></th>
        <th>ID</th>
        <th>Назва категорії</th>
        <th>Кількість фото</th>
    </tr>
    <?php foreach ($photogallery_sections_list as $item): ?>
    <tr>
    <?="<td><input name='photogallery_section_id' type='radio' value='$item[photogallery_section_id]'></td>
        <td>$item[photogallery_section_id]</td>
        <td>$item[title]</td>
        <td>$item[count_photo]</td>;"?>
    </tr>
    <?php endforeach;?>
</table>

<p><input type = "submit" name = "delete_button" id = "delete_button" value = "" /></p>

</form>

<div style="clear: both;">&nbsp;</div>
<a href="#top">Наверх</a>

</div>