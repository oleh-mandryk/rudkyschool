<div id="content">
<div id="left">
<h2>���� ����� ��� �����������</h2>
<table class="admin_wrap">
    <tr>
        <th>ID</th>
        <th>����</th>
        <th>����</th>
        <th>�������</th>
        <th>�������</th>
        <th>�������</th>
        <th>������</th>
        <th>������</th>
        <th>���� �����</th>
    </tr>
    <?php foreach ($schedule_list as $item):?>
    <tr>
        <td><a href = "<?=base_url()."schedule/edit_schedule/$item[schedule_id]";?>"><?="$item[schedule_id]";?></a></td>
        <td><a href = "<?=base_url()."schedule/edit_schedule/$item[schedule_id]";?>"><?="$item[group_id]";?></a></td>
        <td><a href = "<?=base_url()."schedule/edit_schedule/$item[schedule_id]";?>"><?="$item[lesson]";?></a></td>
        <td><a href = "<?=base_url()."schedule/edit_schedule/$item[schedule_id]";?>"><?="$item[subject]";?></a></td>
        <td><a href = "<?=base_url()."schedule/edit_schedule/$item[schedule_id]";?>"><?="$item[teacher0]";?></a></td>
        <td><a href = "<?=base_url()."schedule/edit_schedule/$item[schedule_id]";?>"><?="$item[teacher1]";?></a></td>
        <td><a href = "<?=base_url()."schedule/edit_schedule/$item[schedule_id]";?>"><?="$item[audience0]";?></a></td>
        <td><a href = "<?=base_url()."schedule/edit_schedule/$item[schedule_id]";?>"><?="$item[audience1]";?></a></td>
        <td><a href = "<?=base_url()."schedule/edit_schedule/$item[schedule_id]";?>"><?="$item[day_id]";?></a></td>
    </tr>
    <?php endforeach;?>
</table>
<div style="clear: both;">&nbsp;</div>
<div id="pagination"><p><?=$page_nav;?></p></div>
<a href="#top">������</a>
</div>