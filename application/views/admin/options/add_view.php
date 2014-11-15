<div id="content">
<div id="left">
<h2>Добавлення нової відповіді для голосування</h2>

<form action = "<?=base_url();?>polls/add_options" method="post">

<p>Відповідь<br />
<input type="text" id="form_char" name="value" value="<?=set_value('value');?>" /><br />
<div id="error"><p><?=form_error('value');?></p></div> 
</p>

<p><input type = "submit" name = "add_button" id = "add_button" value = "" /></p>

</form>

<div style="clear: both;">&nbsp;</div>
<a href="#top">Наверх</a>

</div>