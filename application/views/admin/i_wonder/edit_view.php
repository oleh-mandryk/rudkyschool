<div id="content">
<div id="left">
<h2>Редагування цікаво знати</h2>
<?=get_tinymce();?>
<form action = "<?=base_url()."i_wonder/update/$i_wonder_id";?>" method="post">

<p>Основний вміст цікаво знати<br />
<textarea id="form_text" name="main_text" cols="75" rows="20"><?=set_value('main_text', $main_text);?></textarea><br /><a href="javascript:setup();">Використовувати TinyMCE</a><br/>
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