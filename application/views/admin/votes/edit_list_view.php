<div id="content">
<div id="left">
<h2>���� ���������� ����������� ��� �����������</h2>
<table class="admin_wrap">
    <tr>
        <th>ID</th>
        <th>³������</th>
        <th>���� �����������</th>
        <th>IP-������</th>
    </tr>
    <?php foreach ($votes_list as $item):?>
    <tr>
        <td><a href = "<?=base_url()."polls/edit_votes/$item[vote_id]";?>"><?="$item[vote_id]";?></a></td>
        <td><a href = "<?=base_url()."polls/edit_votes/$item[vote_id]";?>"><?="$item[option_id]";?></a></td>
        <td><a href = "<?=base_url()."polls/edit_votes/$item[vote_id]";?>"><?="$item[voted_on]";?></a></td>
        <td><a href = "<?=base_url()."polls/edit_votes/$item[vote_id]";?>"><?="$item[ip]";?></a></td>
    </tr>
    <?php endforeach;?>
</table>
<div style="clear: both;">&nbsp;</div>
<a href="#top">������</a>
</div>