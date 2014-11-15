<div id="content">
<div id="left">
<h2>¬х≥д в панель адм≥н≥стратора</h2>
<form action = "<?=base_url();?>administration/login" method="post">
<p>Ћог≥н<br />
<input type="text" id="form_char" name="login" value="<?=set_value('login');?>" /><br />
<div id="error"><p><?=form_error('login');?></p></div>
</p>
<p>ѕароль<br />
<input type="password" id="form_char" name="pass" /><br />
<div id="error"><p><?=form_error('pass');?></p></div>
</p>
<p><input type = "submit" id = "input_button" name = "input_button" value = "" /></p>
</form>
</div>