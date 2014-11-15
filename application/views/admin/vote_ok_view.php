<div id="content">
	<div id="left">
		<h2>Результати голосування</h2>
<?php if (isset($_POST['vote_button'])) {?>
                    <div id="not_error"><strong><?=$info_vote_ok?></strong></div>
                <?php } ?>
                    
                        <p><strong><?=$questions_vote_all[0]['ques']?></strong></p>
                        <?php	foreach ($showresults_all as $one):
                        $percent=round(($one['votes']*100)/$count_votes['totalvotes']); ?> 
                        <?=$one['value'].' '?> <strong><?=$one['votes']?></strong> <?=' ('.$percent.'%'.')';?>
                        <div class="bar " style="width: <?=$percent?>%;"></div>
                        <?php endforeach; ?> 
                        <br />
                        <p>Всього голосів: <strong><?=$count_votes['totalvotes'];?></strong><br />
                        Перший голос: <strong><?=$first_vote['voted_on'];?></strong><br />
                        Останній голос: <strong><?=$last_vote['voted_on'];?></strong><br />
                        </p>
</div>