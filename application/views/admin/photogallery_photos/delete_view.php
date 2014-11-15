<div id="content">
<div id="left">
<h2>Видалення фотографії</h2>

<form action = "<?=base_url();?>photogallery_photos/delete" method="post">  
<table class="admin_wrap">
    <tr>
        <th></th>
        <th>ID</th>
        <th>Підпис фотографії</th>
        <th>Категорія</th>
        <th>Дата добавлення</th>
        <th>Зображення</th>
    </tr>
    <?php foreach ($photogallery_list as $item): ?>
    <tr>
    <?="<td><input name='photogallery_photo_id' type='radio' value='$item[photogallery_photo_id]'></td>
        <td>$item[photogallery_photo_id]</td>
        <td>$item[title]</td>
        <td>$item[photogallery_section]</td>
        <td>$item[date]</td>";?>
        <td><img src="<?=base_url().$item['url_small_img']?>" /></td>
    </tr>
    <?php endforeach;?>
</table>

<p><input type = "submit" name = "delete_button" id = "delete_button" value = "" /></p>

</form>

<div style="clear: both;">&nbsp;</div>
<div id="pagination"><p><?=$page_nav;?></p></div>
<a href="#top">Наверх</a>

</div>