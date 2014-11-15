<div id="content">
<div id="left">
<h2>Видалення фотографії</h2>

<form action = "<?=base_url();?>footer_img/delete" method="post">  
<table class="admin_wrap">
    <tr>
        <th></th>
        <th>ID</th>
        <th>Альтернативний текст</th>
        <th>URL адреса</th>
        <th>Зображення</th>
    </tr>
    <?php foreach ($footer_list as $item): ?>
    <tr>
    <?="<td><input name='img_footer_id' type='radio' value='$item[img_footer_id]'></td>
        <td>$item[img_footer_id]</td>
        <td>$item[alt_text]</td>
        <td>$item[url_address]</td>";?>
        <td><img src="<?=base_url().$item['img_url']?>" /></td>
    </tr>
    <?php endforeach;?>
</table>

<p><input type = "submit" name = "delete_button" id = "delete_button" value = "" /></p>

</form>

<div style="clear: both;">&nbsp;</div>
<a href="#top">Наверх</a>

</div>