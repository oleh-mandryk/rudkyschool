<div id="content">
	<div id="left">
        <h2>Розклад занять на <?=$schedule_date['date']?></h2>
        <table><tr><td><a class="print" href ='javascript:window.print(); void 0; '><img src="../img/printer-icon.jpg"/></a></td></tr></table>
        <form action="<?=base_url();?>schedule/schedule_pupils" method="post" name="schedule_pupils">
        <p>
        <select onchange="submit();" name="schedule_pupils" id="form_select">
            <option value="Виберіть клас" disabled="disabled" selected="selected">Виберіть клас</option>
            <?php   foreach ($groups_all as $one):?>
            <?php   foreach ($one as $groups_dist):?>
                <option value="<?=$groups_dist?>" <?=populate_select($names_sel,$groups_dist);
echo set_select('schedule_pupils',$groups_dist);?> ><?=$groups_dist?></option>
            <?php   endforeach; ?>
            <?php   endforeach; ?>
        </select>
        </p>
        </form>
        
<?php if (isset($_POST['schedule_pupils'])) 
{
    print"<table>";
    print"<tr>";
    print"<th class=\"rowD\">Урок</th>";
    print"<th class=\"rowD\">Назва предмету</th>";
    print"<th class=\"rowD\">Вчитель</th>";
    print"<th class=\"rowD\">Кабінет</th>";
    print"</tr>";
    
    print"<tr>";
    print"<td class=\"rowC\" colspan=\"4\" align=\"center\"><strong>Понеділок</strong></td>";
    print"</tr>";
    
    foreach ($schedule_monday as $two):
    print"<tr>";
    print"<td class=\"rowB\">{$two['lesson']}</td>";
    print"<td class=\"rowB\">{$two['subject']}</td>";
    print"<td class=\"rowB\">{$two['teacher0']} {$two['teacher1']}</td>";
    print"<td class=\"rowB\">{$two['audience0']} {$two['audience1']}</td>";
    print"</tr>";
    endforeach;
    
    print"<tr>";
    print"<td class=\"rowC\" colspan=\"4\" align=\"center\"><strong>Вівторок</strong></td>";
    print"</tr>";
    
    foreach ($schedule_tuesday as $two):
    print"<tr>";
    print"<td class=\"rowB\">{$two['lesson']}</td>";
    print"<td class=\"rowB\">{$two['subject']}</td>";
    print"<td class=\"rowB\">{$two['teacher0']} {$two['teacher1']}</td>";
    print"<td class=\"rowB\">{$two['audience0']} {$two['audience1']}</td>";
    print"</tr>";
    endforeach;
    
    print"<tr>";
    print"<td class=\"rowC\" colspan=\"4\" align=\"center\"><strong>Середа</strong></td>";
    print"</tr>";
    
    foreach ($schedule_wednesday as $two):
    print"<tr>";
    print"<td class=\"rowB\">{$two['lesson']}</td>";
    print"<td class=\"rowB\">{$two['subject']}</td>";
    print"<td class=\"rowB\">{$two['teacher0']} {$two['teacher1']}</td>";
    print"<td class=\"rowB\">{$two['audience0']} {$two['audience1']}</td>";
    print"</tr>";
    endforeach;
    
    print"<tr>";
    print"<td class=\"rowC\" colspan=\"4\" align=\"center\"><strong>Четвер</strong></td>";
    print"</tr>";
    
    foreach ($schedule_thursday as $two):
    print"<tr>";
    print"<td class=\"rowB\">{$two['lesson']}</td>";
    print"<td class=\"rowB\">{$two['subject']}</td>";
    print"<td class=\"rowB\">{$two['teacher0']} {$two['teacher1']}</td>";
    print"<td class=\"rowB\">{$two['audience0']} {$two['audience1']}</td>";
    print"</tr>";
    endforeach;
    
    print"<tr>";
    print"<td class=\"rowC\" colspan=\"4\" align=\"center\"><strong>П'ятниця</strong></td>";
    print"</tr>";
    
    foreach ($schedule_friday as $two):
    print"<tr>";
    print"<td class=\"rowB\">{$two['lesson']}</td>";
    print"<td class=\"rowB\">{$two['subject']}</td>";
    print"<td class=\"rowB\">{$two['teacher0']} {$two['teacher1']}</td>";
    print"<td class=\"rowB\">{$two['audience0']} {$two['audience1']}</td>";
    print"</tr>";
    endforeach;
    
    print"</table>";    
}
?>
 
<div style="clear: both;">&nbsp;</div>
			<a href="#top">Наверх</a>
</div>