<div id="content">
<div id="left">
<h2>Редагування результатів голосування</h2>

<form action = "<?=base_url()."polls/update_votes/$vote_id";?>" method="post">

<p>Відповідь<br />
<input type="text" id="form_char" name="option_id" value="<?=set_value('option_id', $option_id);?>" /><br />
<div id="error"><p><?=form_error('option_id');?></p></div> 
</p>

<p>Дата голосування<br />
<input type="text" id="form_char" name="voted_on" value="<?=set_value('voted_on', $voted_on);?>" /><br />
<div id="error"><p><?=form_error('voted_on');?></p></div> 
</p>

<p>IP-адреса<br />
<input type="text" id="form_char" name="ip" value="<?=set_value('ip', $ip);?>" /><br />
<div id="error"><p><?=form_error('ip');?></p></div> 
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