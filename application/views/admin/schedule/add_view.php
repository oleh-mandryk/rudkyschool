<div id="content">
<div id="left">
<h2>���������� �����</h2>

<form action = "<?=base_url();?>schedule/add_schedule" method="post">

<p>����<br />
<input type="text" id="form_char" name="group_id" value="<?=set_value('group_id');?>" /><br />
<div id="error"><p><?=form_error('group_id');?></p></div> 
</p>

<p>����<br />
<input type="text" id="form_char" name="lesson" value="<?=set_value('lesson');?>" /><br />
<div id="error"><p><?=form_error('lesson');?></p></div> 
</p>

<p>�������<br />
<input type="text" id="form_char" name="subject" value="<?=set_value('subject');?>" /><br />
<div id="error"><p><?=form_error('subject');?></p></div> 
</p>

<p>�������<br />
<input type="text" id="form_char" name="teacher0" value="<?=set_value('teacher0');?>" /><br />
<div id="error"><p><?=form_error('teacher0');?></p></div> 
</p>

<p>�������<br />
<input type="text" id="form_char" name="teacher1" value="<?=set_value('teacher1');?>" /><br />
<div id="error"><p><?=form_error('teacher1');?></p></div> 
</p>

<p>������<br />
<input type="text" id="form_char" name="audience0" value="<?=set_value('audience0');?>" /><br />
<div id="error"><p><?=form_error('audience0');?></p></div> 
</p>

<p>������<br />
<input type="text" id="form_char" name="audience1" value="<?=set_value('audience1');?>" /><br />
<div id="error"><p><?=form_error('audience1');?></p></div> 
</p>

<p>���� �����<br />
<select name="day_id" id="form_select">
<option value="��������" <?php echo set_select('day_id', '��������'); ?>>��������</option>
<option value="³������" <?php echo set_select('day_id', '³������'); ?>>³������</option>
<option value="������" <?php echo set_select('day_id', '������'); ?>>������</option>
<option value="������" <?php echo set_select('day_id', '������'); ?>>������</option>
<option value="�'������" <?php echo set_select('day_id', '�\'������'); ?>>�'������</option>
</select>
</p>

<p><input type = "submit" name = "add_button" id = "add_button" value = "" /></p>

</form>

<div style="clear: both;">&nbsp;</div>
<a href="#top">������</a>

</div>