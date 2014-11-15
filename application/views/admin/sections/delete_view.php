<div id="content">
<div id="left">
<h2>Видалення категорії</h2>

<form action = "<?=base_url();?>sections/delete" method="post">  
<table class="admin_wrap">
    <tr>
        <th></th>
        <th>ID</th>
        <th>Назва категорії</th>
    </tr>
    <?php foreach ($sections_list as $item): ?>
    <tr>
    <?="<td><input name='section_id' type='radio' value='$item[section_id]'></td>
        <td>$item[section_id]</td>
        <td>$item[title]</td>";?>
    </tr>
    <?php endforeach;?>
</table>

<p><input type = "submit" name = "delete_button" id = "delete_button" value = "" /></p>

</form>

<div style="clear: both;">&nbsp;</div>
<a href="#top">Наверх</a>

</div>