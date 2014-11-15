<div id="content">
<div id="left">
<h2>Видалення цікаво знати</h2>

<form action = "<?=base_url();?>i_wonder/delete" method="post">  
<table class="admin_wrap">
    <tr>
        <th></th>
        <th>ID</th>
        <th>Цікаво знати</th>
    </tr>
    <?php foreach ($i_wonder_list as $item): ?>
    <tr>
    <?="<td><input name='i_wonder_id' type='radio' value='$item[i_wonder_id]'></td>
        <td>$item[i_wonder_id]</td>
        <td>$item[main_text]</td>";?>
    </tr>
    <?php endforeach;?>
</table>

<p><input type = "submit" name = "delete_button" id = "delete_button" value = "" /></p>

</form>

<div style="clear: both;">&nbsp;</div>
<div id="pagination"><p><?=$page_nav;?></p></div>
<a href="#top">Наверх</a>

</div>