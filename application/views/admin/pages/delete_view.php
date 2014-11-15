<div id="content">
<div id="left">
<h2>Видалення сторінки</h2>

<form action = "<?=base_url();?>pages/delete" method="post">  
<table class="admin_wrap">
    <tr>
        <th></th>
        <th>ID</th>
        <th>Назва сторінки</th>
    </tr>
    <?php foreach ($pages_list as $item): ?>
    <tr>
    <?="<td><input name='page_id' type='radio' value='$item[page_id]'></td>
        <td>$item[page_id]</td>
        <td>$item[title]</td>";?>
    </tr>
    <?php endforeach;?>
</table>

<p><input type = "submit" name = "delete_button" id = "delete_button" value = "" /></p>

</form>

<div style="clear: both;">&nbsp;</div>
<a href="#top">Наверх</a>

</div>