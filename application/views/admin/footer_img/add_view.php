<div id="content">
<div id="left">
<h2>���������� ������ ���������� ��� ������</h2>

<form action = "<?=base_url();?>footer_img/add" enctype="multipart/form-data" method="post">

<p>�������������� �����<br />
<input type="text" id="form_char" name="alt_text" value="<?=set_value('alt_text');?>" /><br />
<div id="error"><p><?=form_error('alt_text');?></p></div> 
</p>

<p>URL ������<br />
<input type="text" id="form_char" name="url_address" value="<?=set_value('url_address');?>" /><br />
<div id="error"><p><?=form_error('url_address');?></p></div> 
</p>

<p>����������<br />
<input type="file" name="userfile" size="20" /><br />
</p>

<p><input type = "submit" name = "add_button" id = "add_button" value = "" /></p>

</form>

<div style="clear: both;">&nbsp;</div>
<a href="#top">������</a>

</div>