<div id="content">
<div id="left">
<h2>���� ������ ��� �����������</h2>
<table class="admin_wrap">
    <tr>
        <th>ID</th>
        <th>³������</th>
    </tr>
    <?php foreach ($options_list as $item):?>
    <tr>
        <td><a href = "<?=base_url()."polls/edit_options/$item[option_id]";?>"><?="$item[option_id]";?></a></td>
        <td><a href = "<?=base_url()."polls/edit_options/$item[option_id]";?>"><?="$item[value]";?></a></td>
    </tr>
    <?php endforeach;?>
</table>
<div style="clear: both;">&nbsp;</div>
<a href="#top">������</a>
</div>