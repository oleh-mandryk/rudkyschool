<div id="content">
<div id="left">
<h2>Видалення відповіді для голосування</h2>

<form action = "<?=base_url();?>polls/delete_options" method="post">  
<table class="admin_wrap">
    <tr>
        <th></th>
        <th>ID</th>
        <th>Відповідь</th>
    </tr>
    <?php foreach ($options_list as $item): ?>
    <tr>
    <?="<td><input name='option_id' type='radio' value='$item[option_id]'></td>
        <td>$item[option_id]</td>
        <td>$item[value]</td>";?>
    </tr>
    <?php endforeach;?>
</table>

<p><input type = "submit" name = "delete_button" id = "delete_button" value = "" /></p>

</form>

<div style="clear: both;">&nbsp;</div>
<a href="#top">Наверх</a>

</div>