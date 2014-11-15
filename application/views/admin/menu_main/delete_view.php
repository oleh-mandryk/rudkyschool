<div id="content">
<div id="left">
<h2>Видалення пункту головного меню</h2>

<form action = "<?=base_url();?>menu_main/delete" method="post">  
<table class="admin_wrap">
    <tr>
        <th></th>
        <th>ID</th>
        <th>Назва пункту меню</th>
        <th>URL адреса</th>
    </tr>
    <?php foreach ($menu_main_list as $item): ?>
    <tr>
    <?="<td><input name='name_item_id' type='radio' value='$item[name_item_id]'></td>
         <td>$item[name_item_id]</td>
        <td>$item[name_item]</td>
        <td>$item[url_item]</td>";?>
    </tr>
    <?php endforeach;?>
</table>

<p><input type = "submit" name = "delete_button" id = "delete_button" value = "" /></p>

</form>

<div style="clear: both;">&nbsp;</div>
<a href="#top">Наверх</a>

</div>