<div id="content">
	<div id="left">
                <div id="not_error"><p><strong>По запиту "<?=$this->session->userdata('search_query')?>"  знайдено:</strong></p></div>
                                               
<?php
for ($i = $mpsearch_results['start_from']; $i < $mpsearch_results['start_from'] + $mpsearch_results['limit']; $i++)
{
    if (isset($mpsearch_results[$i][0]))
    {    
        $mpsearch_results[$i][1] = highlight_phrase($mpsearch_results[$i][1], $this->session->userdata('search_query'),'<span style="background:#feffc9">','</span>');
        $mpsearch_results[$i][2] = highlight_phrase($mpsearch_results[$i][2], $this->session->userdata('search_query'),'<span style="background:#feffc9">','</span>');
       
        print <<<HERE
        <table>
            <tr>
                <td>
                    <h3><a href = "http://www.vyshnya.lviv.ua/materials/{$mpsearch_results[$i][0]}">{$mpsearch_results[$i][1]}</a></h3>
                </td>    
            </tr>
        </table>
                           
                    <p>{$mpsearch_results[$i][2]}</p>
                    <div style="border-bottom: 1px dashed #60B7DE;">&nbsp;</div>
                 
HERE;
    }
}   
        
        print <<<HERE_1
        <div id="pagination"><p>$page_nav</p></div>
HERE_1
?>
<div style="clear: both;">&nbsp;</div>            
<p><a href="#top">Наверх</a></p>
</div>