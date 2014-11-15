<div id="content">
<div id="left">
<h2>Вибір зображення футера для редагування</h2>
<table class="admin_wrap">
    <tr>
        <th>ID</th>
        <th>Альтернативний текст</th>
        <th>URL адреса</th>
        <th>Зображення</th>
    </tr>
    <?php foreach ($footer_list as $item):?>
    <tr>
        <td><a href = "<?=base_url()."footer_img/edit/$item[img_footer_id]";?>"><?="$item[img_footer_id]";?></a></td>
        <td><a href = "<?=base_url()."footer_img/edit/$item[img_footer_id]";?>"><?="$item[alt_text]";?></a></td>
        <td><a href = "<?=base_url()."footer_img/edit/$item[img_footer_id]";?>"><?="$item[url_address]";?></a></td>
        <td><a href = "<?=base_url()."footer_img/edit/$item[img_footer_id]";?>"><img src="<?=base_url().$item['img_url']?>" /></a></td>
    </tr>
    <?php endforeach;?>
</table>
<div style="clear: both;">&nbsp;</div>
<div id="pagination"><p><?=$page_nav;?></p></div>
<a href="#top">Наверх</a>
</div>