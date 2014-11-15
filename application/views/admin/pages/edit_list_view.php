<div id="content">
<div id="left">
<h2>Вибір сторінки для редагування</h2>
<table class="admin_wrap">
    <tr>
        <th>ID</th>
        <th>Назва сторінки</th>
    </tr>
    <?php foreach ($pages_list as $item):?>
    <tr>
        <td><a href = "<?=base_url()."pages/edit/$item[page_id]";?>"><?="$item[page_id]";?></a></td>
        <td><a href = "<?=base_url()."pages/edit/$item[page_id]";?>"><?="$item[title]";?></a></td>
    </tr>
    <?php endforeach;?>
</table>
<div style="clear: both;">&nbsp;</div>
<a href="#top">Наверх</a>
</div>