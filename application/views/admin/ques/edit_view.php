<div id="content">
<div id="left">
<h2>����������� ���������</h2>
<form action = "<?=base_url()."polls/update_ques/$ques_id";?>" method="post">

<p>���������<br />
<input type="text" id="form_char" name="ques" value="<?=set_value('ques', $ques);?>" /><br />
<div id="error"><p><?=form_error('ques');?></p></div> 
</p>

<p><input type = "submit" name = "update_button" id ="update_button" value = "" /></p>

</form>

<div style="clear: both;">&nbsp;</div>
<a href="#top">������</a>

</div>