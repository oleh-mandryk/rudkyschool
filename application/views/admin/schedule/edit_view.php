<div id="content">
<div id="left">
<h2>����������� �����</h2>

<form action = "<?=base_url()."schedule/update_schedule/$schedule_id";?>" method="post">

<p>����<br />
<input type="text" id="form_char" name="group_id" value="<?=set_value('group_id', $group_id);?>" /><br />
<div id="error"><p><?=form_error('group_id');?></p></div> 
</p>

<p>����<br />
<input type="text" id="form_char" name="lesson" value="<?=set_value('lesson', $lesson);?>" /><br />
<div id="error"><p><?=form_error('lesson');?></p></div> 
</p>

<p>�������<br />
<input type="text" id="form_char" name="subject" value="<?=set_value('subject', $subject);?>" /><br />
<div id="error"><p><?=form_error('subject');?></p></div> 
</p>

<p>�������<br />
<input type="text" id="form_char" name="teacher0" value="<?=set_value('teacher0', $teacher0);?>" /><br />
<div id="error"><p><?=form_error('teacher0');?></p></div> 
</p>

<p>�������<br />
<input type="text" id="form_char" name="teacher1" value="<?=set_value('teacher1', $teacher1);?>" /><br />
<div id="error"><p><?=form_error('teacher1');?></p></div> 
</p>

<p>������<br />
<input type="text" id="form_char" name="audience0" value="<?=set_value('audience0', $audience0);?>" /><br />
<div id="error"><p><?=form_error('audience0');?></p></div> 
</p>

<p>������<br />
<input type="text" id="form_char" name="audience1" value="<?=set_value('audience1', $audience1);?>" /><br />
<div id="error"><p><?=form_error('audience1');?></p></div> 
</p>

<p>���� �����<br />
<select name="day_id" id="form_select">
<option value="��������" <?=populate_select_admin($names_sel,'��������'); echo set_select('day_id','��������');?>>��������</option>
<option value="³������" <?=populate_select_admin($names_sel,'³������'); echo set_select('day_id','³������');?>>³������</option>
<option value="������" <?=populate_select_admin($names_sel,'������'); echo set_select('day_id','������');?>>������</option>
<option value="������" <?=populate_select_admin($names_sel,'������'); echo set_select('day_id','������');?>>������</option>
<option value="�'������" <?=populate_select_admin($names_sel,'�\'������'); echo set_select('day_id','�\'������');?>>�'������</option>
</select>
</p>

<p>���������<br/>
<input type="radio" name="publish_id" value="1" <?=populate_publish($names_pub,1);
echo set_radio('publish_id',1);?> id="1" />
<label for='1'>���</label>
<input type="radio" name="publish_id" value="0" <?=populate_publish($names_pub,0);
echo set_radio('publish_id',0);?> id="0" />
<label for='0'>ͳ</label><br />

<div id="error"><p><?=form_error('publish_id');?></p></div> 
</p>

<p><input type = "submit" name = "update_button" id ="update_button" value = "" /></p>

</form>

<div style="clear: both;">&nbsp;</div>
<a href="#top">������</a>

</div>