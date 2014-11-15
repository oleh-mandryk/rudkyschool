<div id="content">
<div id="left">
<h2>Видалення результату голосування</h2>

<form action = "<?=base_url();?>polls/delete_votes" method="post">  
<table class="admin_wrap">
    <tr>
        <th></th>
        <th>ID</th>
        <th>Відповідь</th>
        <th>Дата голосування</th>
        <th>IP-адреса</th>
    </tr>
    <?php foreach ($votes_list as $item): ?>
    <tr>
    <?="<td><input name='vote_id' type='radio' value='$item[vote_id]'></td>
        <td>$item[vote_id]</td>
        <td>$item[option_id]</td>
        <td>$item[voted_on]</td>
        <td>$item[ip]</td>";?>
    </tr>
    <?php endforeach;?>
</table>

<p><input type = "submit" name = "delete_button" id = "delete_button" value = "" /></p>

</form>

<div style="clear: both;">&nbsp;</div>
<a href="#top">Наверх</a>

</div>