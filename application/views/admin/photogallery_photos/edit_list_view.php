<div id="content">
<div id="left">
<h2>���� ���������� ��� �����������</h2>
<table class="admin_wrap">
    <tr>
        <th>ID</th>
        <th>ϳ���� ����������</th>
        <th>��������</th>
        <th>���� ����������</th>
        <th>����������</th>
    </tr>
    <?php foreach ($photogallery_photos_list as $item):?>
    <tr>
        <td><a href = "<?=base_url()."photogallery_photos/edit/$item[photogallery_photo_id]";?>"><?="$item[photogallery_photo_id]";?></a></td>
        <td><a href = "<?=base_url()."photogallery_photos/edit/$item[photogallery_photo_id]";?>"><?="$item[title]";?></a></td>
        <td><a href = "<?=base_url()."photogallery_photos/edit/$item[photogallery_photo_id]";?>"><?="$item[photogallery_section]";?></a></td>
        <td><a href = "<?=base_url()."photogallery_photos/edit/$item[photogallery_photo_id]";?>"><?="$item[date]";?></a></td>
        <td><a href = "<?=base_url()."photogallery_photos/edit/$item[photogallery_photo_id]";?>"><img src="<?=base_url().$item['url_small_img']?>" /></a></td>
    </tr>
    <?php endforeach;?>
</table>
<div style="clear: both;">&nbsp;</div>
<div id="pagination"><p><?=$page_nav;?></p></div>
<a href="#top">������</a>
</div>