<div id="content">
<div id="left">
<h2>���� ��������� ������ ���� ��� �����������</h2>
<table class="admin_wrap">
    <tr>
        <th>ID</th>
        <th>����� ������ ����</th>
        <th>URL ������</th>
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
<a href="#top">������</a>
</div>