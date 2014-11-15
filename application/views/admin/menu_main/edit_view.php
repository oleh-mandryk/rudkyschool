<div id="content">
<div id="left">
<h2>Редагування головного пункту меню</h2>
<?=get_tinymce();?>
<form action = "<?=base_url()."menu_main/update/$name_item_id";?>" method="post">

<p>Назва пункту меню<br />
<input type="text" id="form_char" name="name_item" value="<?=set_value('name_item', $name_item);?>" /><br />
<div id="error"><p><?=form_error('name_item');?></p></div> 
</p>

<p>URL адреса<br />
<input type="text" id="form_char" name="url_item" value="<?=set_value('url_item', $url_item);?>" /><br />
<div id="error"><p><?=form_error('url_item');?></p></div> 
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