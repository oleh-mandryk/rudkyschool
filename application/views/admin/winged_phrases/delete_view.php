<div id="content">
<div id="left">
<h2>Видалення крилатої фрази</h2>

<form action = "<?=base_url();?>winged_phrases/delete" method="post">  
<table class="admin_wrap">
    <tr>
        <th></th>
        <th>ID</th>
        <th>Крилата фраза</th>
        <th>Автор</th>
    </tr>
    <?php foreach ($winged_phrases_list as $item): ?>
    <tr>
    <?="<td><input name='winged_phrases_id' type='radio' value='$item[winged_phrases_id]'></td>
        <td>$item[winged_phrases_id]</td>
        <td>$item[main_text]</td>
        <td>$item[author]</td>";?>
    </tr>
    <?php endforeach;?>
</table>

<p><input type = "submit" name = "delete_button" id = "delete_button" value = "" /></p>

</form>

<div style="clear: both;">&nbsp;</div>
<div id="pagination"><p><?=$page_nav;?></p></div>
<a href="#top">Наверх</a>

</div>