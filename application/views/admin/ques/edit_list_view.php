<div id="content">
<div id="left">
<h2>Вибір запитання для редагування</h2>
<table class="admin_wrap">
    <tr>
        <th>ID</th>
        <th>Запитання</th>
    </tr>
    <?php foreach ($ques_list as $item):?>
    <tr>
        <td><a href = "<?=base_url()."polls/edit_ques/$item[ques_id]";?>"><?="$item[ques_id]";?></a></td>
        <td><a href = "<?=base_url()."polls/edit_ques/$item[ques_id]";?>"><?="$item[ques]";?></a></td>
    </tr>
    <?php endforeach;?>
</table>
<div style="clear: both;">&nbsp;</div>
<a href="#top">Наверх</a>
</div>