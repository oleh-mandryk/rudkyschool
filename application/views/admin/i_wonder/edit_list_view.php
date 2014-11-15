<div id="content">
<div id="left">
<h2>Вибір цікаво знати для редагування</h2>
<table class="admin_wrap">
    <tr>
        <th>ID</th>
        <th>Цікаво знати</th>
    </tr>
    <?php foreach ($i_wonder_list as $item):?>
    <tr>
        <td><a href = "<?=base_url()."i_wonder/edit/$item[i_wonder_id]";?>"><?="$item[i_wonder_id]";?></a></td>
        <td><a href = "<?=base_url()."i_wonder/edit/$item[i_wonder_id]";?>"><?="$item[main_text]";?></a></td>
    </tr>
    <?php endforeach;?>
</table>
<div style="clear: both;">&nbsp;</div>
<div id="pagination"><p><?=$page_nav;?></p></div>
<a href="#top">Наверх</a>
</div>