<div id="content">
<div id="left">
<h2>����������� ������� �����</h2>
<?=get_tinymce();?>
<form action = "<?=base_url()."winged_phrases/update/$winged_phrases_id";?>" method="post">

<p>�������� ���� ������� �����<br />
<textarea id="form_text" name="main_text" cols="75" rows="20"><?=set_value('main_text', $main_text);?></textarea><br /><a href="javascript:setup();">��������������� TinyMCE</a><br/>
</p>

<p>�����<br />
<input type="text" id="form_char" name="author" value="<?=set_value('author', $author);?>" /><br />
<div id="error"><p><?=form_error('author');?></p></div> 
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