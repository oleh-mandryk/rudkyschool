<div id="content">
<div id="left">
<h2>���������� ������ �����</h2>
<?=get_tinymce();?>
<form action = "<?=base_url();?>i_wonder/add" method="post">

<p>�������� ���� ������ �����<br />
<textarea id="form_text" name="main_text" cols="75" rows="20"><?=set_value('main_text');?></textarea><br /><a href="javascript:setup();">����������� TinyMCE</a><br />
<div id="error"><p><?=form_error('main_text');?></p></div> 
</p>

<p><input type = "submit" name = "add_button" id = "add_button" value = "" /></p>

</form>

<div style="clear: both;">&nbsp;</div>
<a href="#top">������</a>

</div>