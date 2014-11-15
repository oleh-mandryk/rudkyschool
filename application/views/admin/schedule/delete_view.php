<div id="content">
<div id="left">
<h2>Видалення уроку</h2>

<form action = "<?=base_url();?>schedule/delete_schedule" method="post">  
<table class="admin_wrap">
    <tr>
        <th></th>
        <th>ID</th>
        <th>Клас</th>
        <th>Урок</th>
        <th>Предмет</th>
        <th>Вчитель</th>
        <th>Вчитель</th>
        <th>Кабінет</th>
        <th>Кабінет</th>
        <th>День тижня</th>
    </tr>
    <?php foreach ($schedule_list as $item): ?>
    <tr>
    <?="<td><input name='schedule_id' type='radio' value='$item[schedule_id]'></td>
        <td>$item[schedule_id]</td>
        <td>$item[group_id]</td>
        <td>$item[lesson]</td>
        <td>$item[subject]</td>
        <td>$item[teacher0]</td>
        <td>$item[teacher1]</td>
        <td>$item[audience0]</td>
        <td>$item[audience1]</td>
        <td>$item[day_id]</td>";?>
    </tr>
    <?php endforeach;?>
</table>

<p><input type = "submit" name = "delete_button" id = "delete_button" value = "" /></p>

</form>

<div style="clear: both;">&nbsp;</div>
<div id="pagination"><p><?=$page_nav;?></p></div>
<a href="#top">Наверх</a>

</div>