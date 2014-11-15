<div id="content">
	<div id="left">
        <h2>Методичні матеріали вчителям</h2>
        <table><tr><td><a class="print" href ='javascript:window.print(); void 0; '><img src="../img/printer-icon.jpg"/></a></td></tr></table>
        <form action="<?=base_url();?>methodical_materials/methodical_materials_teachers" method="post" name="methodical_materials_teachers">
        <p>
        <?php if (empty($_POST['teachers_class']))
        {?>
        <select onchange="submit();" name="teachers_class" id="form_select">
            <option value="Виберіть клас" disabled="disabled" selected="selected">Виберіть клас</option>
            <option value="1" <?php echo set_select('teachers_class', '1'); ?>>1</option>
            <option value="2" <?php echo set_select('teachers_class', '2'); ?>>2</option>
            <option value="3" <?php echo set_select('teachers_class', '3'); ?>>3</option>
            <option value="4" <?php echo set_select('teachers_class', '4'); ?>>4</option>
            <option value="5" <?php echo set_select('teachers_class', '5'); ?>>5</option>
            <option value="6" <?php echo set_select('teachers_class', '6'); ?>>6</option>
            <option value="7" <?php echo set_select('teachers_class', '7'); ?>>7</option>
            <option value="8" <?php echo set_select('teachers_class', '8'); ?>>8</option>
            <option value="9" <?php echo set_select('teachers_class', '9'); ?>>9</option>
            <option value="10" <?php echo set_select('teachers_class', '10'); ?>>10</option>
            <option value="11" <?php echo set_select('teachers_class', '11'); ?>>11</option>
        </select>
        
        <select onchange="submit();" name="teachers_subject" id="form_select">
            <option value="Виберіть предмет" disabled="disabled" selected="selected">Виберіть предмет</option>
        </select>
        </p>  
        </form>
<?php   }
        else
        {
            if (empty($_POST['teachers_subject']))
            {?>
                <select onchange="submit();" name="teachers_class" id="form_select">
                    <option value="Виберіть клас" disabled="disabled" selected="selected">Виберіть клас</option>
                    <option value="1" <?=populate_select_methodical($names_sel,'1'); echo set_select('teachers_class', '1'); ?>>1</option>
                    <option value="2" <?=populate_select_methodical($names_sel,'2'); echo set_select('teachers_class', '2'); ?>>2</option>
                    <option value="3" <?=populate_select_methodical($names_sel,'3'); echo set_select('teachers_class', '3'); ?>>3</option>
                    <option value="4" <?=populate_select_methodical($names_sel,'4'); echo set_select('teachers_class', '4'); ?>>4</option>
                    <option value="5" <?=populate_select_methodical($names_sel,'5'); echo set_select('teachers_class', '5'); ?>>5</option>
                    <option value="6" <?=populate_select_methodical($names_sel,'6'); echo set_select('teachers_class', '6'); ?>>6</option>
                    <option value="7" <?=populate_select_methodical($names_sel,'7'); echo set_select('teachers_class', '7'); ?>>7</option>
                    <option value="8" <?=populate_select_methodical($names_sel,'8'); echo set_select('teachers_class', '8'); ?>>8</option>
                    <option value="9" <?=populate_select_methodical($names_sel,'9'); echo set_select('teachers_class', '9'); ?>>9</option>
                    <option value="10" <?=populate_select_methodical($names_sel,'10'); echo set_select('teachers_class', '10'); ?>>10</option>
                    <option value="11" <?=populate_select_methodical($names_sel,'11'); echo set_select('teachers_class', '11'); ?>>11</option>
                </select>
        
                <select onchange="submit();" name="teachers_subject" id="form_select">
                    <option value="Виберіть предмет" disabled="disabled" selected="selected">Виберіть предмет</option>
                    <?php   foreach ($all_subject as $one):?>
                    <?php   foreach ($one as $subject_dist):?>
                    <option value="<?=$subject_dist?>" <?=populate_select($names_sel,$subject_dist);
                    echo set_select('teachers_subject',$subject_dist);?> ><?=$subject_dist?></option>
                    <?php   endforeach; ?>
                    <?php   endforeach; ?>
                </select>
                </p>  
        </form>
    <?php   }
            else
                        
            {?>
                <select onchange="submit();" name="teachers_class" id="form_select">
                    <option value="Виберіть клас" disabled="disabled" selected="selected">Виберіть клас</option>
                    <option value="1" <?=populate_select_methodical($names_sel,'1'); echo set_select('teachers_class', '1'); ?>>1</option>
                    <option value="2" <?=populate_select_methodical($names_sel,'2'); echo set_select('teachers_class', '2'); ?>>2</option>
                    <option value="3" <?=populate_select_methodical($names_sel,'3'); echo set_select('teachers_class', '3'); ?>>3</option>
                    <option value="4" <?=populate_select_methodical($names_sel,'4'); echo set_select('teachers_class', '4'); ?>>4</option>
                    <option value="5" <?=populate_select_methodical($names_sel,'5'); echo set_select('teachers_class', '5'); ?>>5</option>
                    <option value="6" <?=populate_select_methodical($names_sel,'6'); echo set_select('teachers_class', '6'); ?>>6</option>
                    <option value="7" <?=populate_select_methodical($names_sel,'7'); echo set_select('teachers_class', '7'); ?>>7</option>
                    <option value="8" <?=populate_select_methodical($names_sel,'8'); echo set_select('teachers_class', '8'); ?>>8</option>
                    <option value="9" <?=populate_select_methodical($names_sel,'9'); echo set_select('teachers_class', '9'); ?>>9</option>
                    <option value="10" <?=populate_select_methodical($names_sel,'10'); echo set_select('teachers_class', '10'); ?>>10</option>
                    <option value="11" <?=populate_select_methodical($names_sel,'11'); echo set_select('teachers_class', '11'); ?>>11</option>
                </select>
        
                <select onchange="submit();" name="teachers_subject" id="form_select">
                    <option value="Виберіть предмет" disabled="disabled" selected="selected">Виберіть предмет</option>
                    <?php   foreach ($all_subject as $one):?>
                    <?php   foreach ($one as $subject_dist):?>
                    <option value="<?=$subject_dist?>" <?=populate_select_methodical_1($names_sel_1,$subject_dist);
                    echo set_select('teachers_subject',$subject_dist);?> ><?=$subject_dist?></option>
                    <?php   endforeach; ?>
                    <?php   endforeach; ?>
                </select>
                </p>  
        </form>
                <?php
                if (isset($all_methodical_materials[0]['title'])) {
                print"<table>";
                
                print"<tr>";
                print"<th class=\"rowD\">Назва матеріалу</th>";
                print"<th class=\"rowD\">Автор</th>";
                print"<th class=\"rowD\">Додано</th>";
                print"<th class=\"rowD\">Оновлено</th>";
                print"</tr>";
                        
                foreach ($all_methodical_materials as $one):
                print"<tr>";
                print"<td class=\"rowB\">{$one['title']}</td>";
                print"<td class=\"rowB\">{$one['author_id']}</td>";
                print"<td class=\"rowB\">{$one['date']}</td>";
                print"<td class=\"rowB\">{$one['date_update']}</td>";
                ?>
                <td><a href="<?=base_url().$one['url_material']?>"><img src="<?=base_url()."img/save.jpg"?>"/></a></td>
                <?php
                print"</tr>";
                endforeach;
    
                print"</table>";
                }
                ?> 
        
    <?php  } ?>
<?php  } ?>
        
 
<div style="clear: both;">&nbsp;</div>
			<a href="#top">Наверх</a>
</div>