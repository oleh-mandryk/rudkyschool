<div id="content">
<div id="left">
<h2>���� ������� ��� �����������</h2>
<table class="admin_wrap">
    <tr>
        <th>ID</th>
        <th>����� �������</th>
    </tr>
    <?php foreach ($sections_list as $item):?>
    <tr>
        <td><a href = "<?=base_url()."sections/edit/$item[section_id]";?>"><?="$item[section_id]";?></a></td>
        <td><a href = "<?=base_url()."sections/edit/$item[section_id]";?>"><?="$item[title]";?></a></td>
    </tr>
    <?php endforeach;?>
</table>
<div style="clear: both;">&nbsp;</div>
<a href="#top">������</a>
</div>