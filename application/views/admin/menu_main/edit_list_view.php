<div id="content">
<div id="left">
<h2>Вибір головного пункту меню для редагування</h2>
<table class="admin_wrap">
    <tr>
        <th>ID</th>
        <th>Назва пункту меню</th>
        <th>URL адреса</th>
    </tr>
    <?php foreach ($menu_main_list as $item):?>
    <tr>
        <td><a href = "<?=base_url()."menu_main/edit/$item[name_item_id]";?>"><?="$item[name_item_id]";?></a></td>
        <td><a href = "<?=base_url()."menu_main/edit/$item[name_item_id]";?>"><?="$item[name_item]";?></a></td>
        <td><a href = "<?=base_url()."menu_main/edit/$item[name_item_id]";?>"><?="$item[url_item]";?></a></td>
    </tr>
    <?php endforeach;?>
</table>
<div style="clear: both;">&nbsp;</div>
<a href="#top">Наверх</a>
</div>