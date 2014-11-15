<div id="content">
<div id="left">
<h2>Вибір крилатої фрази для редагування</h2>
<table class="admin_wrap">
    <tr>
        <th>ID</th>
        <th>Крилата фраза</th>
        <th>Автор</th>
    </tr>
    <?php foreach ($winged_phrases_list as $item):?>
    <tr>
        <td><a href = "<?=base_url()."winged_phrases/edit/$item[winged_phrases_id]";?>"><?="$item[winged_phrases_id]";?></a></td>
        <td><a href = "<?=base_url()."winged_phrases/edit/$item[winged_phrases_id]";?>"><?="$item[main_text]";?></a></td>
        <td><a href = "<?=base_url()."winged_phrases/edit/$item[winged_phrases_id]";?>"><?="$item[author]";?></a></td>
    </tr>
    <?php endforeach;?>
</table>
<div style="clear: both;">&nbsp;</div>
<div id="pagination"><p><?=$page_nav;?></p></div>
<a href="#top">Наверх</a>
</div>