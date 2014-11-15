<div id="content">
<div id="left">
<h2>Добавлення крилатої фрази</h2>
<?=get_tinymce();?>
<form action = "<?=base_url();?>winged_phrases/add" method="post">

<p>Основний вміст крилатої фрази<br />
<textarea id="form_text" name="main_text" cols="75" rows="20"><?=set_value('main_text');?></textarea><br /><a href="javascript:setup();">Використати TinyMCE</a><br />
<div id="error"><p><?=form_error('main_text');?></p></div> 
</p>

<p>Автор<br />
<input type="text" id="form_char" name="author" value="<?=set_value('author');?>" /><br />
<div id="error"><p><?=form_error('author');?></p></div> 
</p>

<p><input type = "submit" name = "add_button" id = "add_button" value = "" /></p>

</form>

<div style="clear: both;">&nbsp;</div>
<a href="#top">Наверх</a>

</div>