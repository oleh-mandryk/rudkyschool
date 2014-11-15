<div id="content">
<div id="left">
<h2>Редагування уроку</h2>

<form action = "<?=base_url()."schedule/update_schedule/$schedule_id";?>" method="post">

<p>Клас<br />
<input type="text" id="form_char" name="group_id" value="<?=set_value('group_id', $group_id);?>" /><br />
<div id="error"><p><?=form_error('group_id');?></p></div> 
</p>

<p>Урок<br />
<input type="text" id="form_char" name="lesson" value="<?=set_value('lesson', $lesson);?>" /><br />
<div id="error"><p><?=form_error('lesson');?></p></div> 
</p>

<p>Предмет<br />
<input type="text" id="form_char" name="subject" value="<?=set_value('subject', $subject);?>" /><br />
<div id="error"><p><?=form_error('subject');?></p></div> 
</p>

<p>Вчитель<br />
<input type="text" id="form_char" name="teacher0" value="<?=set_value('teacher0', $teacher0);?>" /><br />
<div id="error"><p><?=form_error('teacher0');?></p></div> 
</p>

<p>Вчитель<br />
<input type="text" id="form_char" name="teacher1" value="<?=set_value('teacher1', $teacher1);?>" /><br />
<div id="error"><p><?=form_error('teacher1');?></p></div> 
</p>

<p>Кабінет<br />
<input type="text" id="form_char" name="audience0" value="<?=set_value('audience0', $audience0);?>" /><br />
<div id="error"><p><?=form_error('audience0');?></p></div> 
</p>

<p>Кабінет<br />
<input type="text" id="form_char" name="audience1" value="<?=set_value('audience1', $audience1);?>" /><br />
<div id="error"><p><?=form_error('audience1');?></p></div> 
</p>

<p>День тижня<br />
<select name="day_id" id="form_select">
<option value="Понеділок" <?=populate_select_admin($names_sel,'Понеділок'); echo set_select('day_id','Понеділок');?>>Понеділок</option>
<option value="Вівторок" <?=populate_select_admin($names_sel,'Вівторок'); echo set_select('day_id','Вівторок');?>>Вівторок</option>
<option value="Середа" <?=populate_select_admin($names_sel,'Середа'); echo set_select('day_id','Середа');?>>Середа</option>
<option value="Четвер" <?=populate_select_admin($names_sel,'Четвер'); echo set_select('day_id','Четвер');?>>Четвер</option>
<option value="П'ятниця" <?=populate_select_admin($names_sel,'П\'ятниця'); echo set_select('day_id','П\'ятниця');?>>П'ятниця</option>
</select>
</p>

<p>Публікація<br/>
<input type="radio" name="publish_id" value="1" <?=populate_publish($names_pub,1);
echo set_radio('publish_id',1);?> id="1" />
<label for='1'>Так</label>
<input type="radio" name="publish_id" value="0" <?=populate_publish($names_pub,0);
echo set_radio('publish_id',0);?> id="0" />
<label for='0'>Ні</label><br />

<div id="error"><p><?=form_error('publish_id');?></p></div> 
</p>

<p><input type = "submit" name = "update_button" id ="update_button" value = "" /></p>

</form>

<div style="clear: both;">&nbsp;</div>
<a href="#top">Наверх</a>

</div>