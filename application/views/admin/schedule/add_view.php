<div id="content">
<div id="left">
<h2>Добавлення уроку</h2>

<form action = "<?=base_url();?>schedule/add_schedule" method="post">

<p>Клас<br />
<input type="text" id="form_char" name="group_id" value="<?=set_value('group_id');?>" /><br />
<div id="error"><p><?=form_error('group_id');?></p></div> 
</p>

<p>Урок<br />
<input type="text" id="form_char" name="lesson" value="<?=set_value('lesson');?>" /><br />
<div id="error"><p><?=form_error('lesson');?></p></div> 
</p>

<p>Предмет<br />
<input type="text" id="form_char" name="subject" value="<?=set_value('subject');?>" /><br />
<div id="error"><p><?=form_error('subject');?></p></div> 
</p>

<p>Вчитель<br />
<input type="text" id="form_char" name="teacher0" value="<?=set_value('teacher0');?>" /><br />
<div id="error"><p><?=form_error('teacher0');?></p></div> 
</p>

<p>Вчитель<br />
<input type="text" id="form_char" name="teacher1" value="<?=set_value('teacher1');?>" /><br />
<div id="error"><p><?=form_error('teacher1');?></p></div> 
</p>

<p>Кабінет<br />
<input type="text" id="form_char" name="audience0" value="<?=set_value('audience0');?>" /><br />
<div id="error"><p><?=form_error('audience0');?></p></div> 
</p>

<p>Кабінет<br />
<input type="text" id="form_char" name="audience1" value="<?=set_value('audience1');?>" /><br />
<div id="error"><p><?=form_error('audience1');?></p></div> 
</p>

<p>День тижня<br />
<select name="day_id" id="form_select">
<option value="Понеділок" <?php echo set_select('day_id', 'Понеділок'); ?>>Понеділок</option>
<option value="Вівторок" <?php echo set_select('day_id', 'Вівторок'); ?>>Вівторок</option>
<option value="Середа" <?php echo set_select('day_id', 'Середа'); ?>>Середа</option>
<option value="Четвер" <?php echo set_select('day_id', 'Четвер'); ?>>Четвер</option>
<option value="П'ятниця" <?php echo set_select('day_id', 'П\'ятниця'); ?>>П'ятниця</option>
</select>
</p>

<p><input type = "submit" name = "add_button" id = "add_button" value = "" /></p>

</form>

<div style="clear: both;">&nbsp;</div>
<a href="#top">Наверх</a>

</div>