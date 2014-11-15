<div id="content">
<div id="left">
<h2>Редагування зображення для футера</h2>

<form action = "<?=base_url()."footer_img/update/$img_footer_id";?>" method="post">

<p>Альтернативний текст<br />
<input type="text" id="form_char" name="alt_text" value="<?=set_value('alt_text', $alt_text);?>" /><br />
<div id="error"><p><?=form_error('alt_text');?></p></div> 
</p>

<p>URL адреса<br />
<input type="text" id="form_char" name="url_address" value="<?=set_value('url_address', $url_address);?>" /><br />
<div id="error"><p><?=form_error('url_address');?></p></div> 
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