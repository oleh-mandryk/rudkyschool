<div id="content">
<div id="left">
<h2>����������� ������ ����������� ����</h2>

<form action = "<?=base_url()."schedule/update_schedule_date/$date_id";?>" method="post">

<p>����� ����������� ����<br />
<input type="text" id="form_char" name="date" value="<?=set_value('date', $date);?>" /><br />
<div id="error"><p><?=form_error('date');?></p></div> 
</p>

<p><input type = "submit" name = "update_button" id ="update_button" value = "" /></p>

</form>

<div style="clear: both;">&nbsp;</div>
<a href="#top">������</a>

</div>