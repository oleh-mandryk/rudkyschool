<div id="content">
<div id="left">
<h2>���� ���������� ������ ��� �����������</h2>
<table class="admin_wrap">
    <tr>
        <th>ID</th>
        <th>�������������� �����</th>
        <th>URL ������</th>
        <th>����������</th>
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
<a href="#top">������</a>
</div>