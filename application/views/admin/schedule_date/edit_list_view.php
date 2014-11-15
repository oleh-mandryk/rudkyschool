<div id="content">
<div id="left">
<h2>Вибір періоду навчального року для редагування</h2>
<table class="admin_wrap">
    <tr>
        <th>ID</th>
        <th>Період навчального року</th>
    </tr>
    <?php foreach ($schedule_date_list as $item):?>
    <tr>
        <td><a href = "<?=base_url()."schedule/edit_schedule_date/$item[date_id]";?>"><?="$item[date_id]";?></a></td>
        <td><a href = "<?=base_url()."schedule/edit_schedule_date/$item[date_id]";?>"><?="$item[date]";?></a></td>
    </tr>
    <?php endforeach;?>
</table>
<div style="clear: both;">&nbsp;</div>
<a href="#top">Наверх</a>
</div>