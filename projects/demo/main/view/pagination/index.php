
<table>
	<?php foreach($list as $key=>$value):?>
    
    <tr>
        <td><?=$value->name?></td>
    </tr>
    
    <?PHP endforeach;?>

</table>

<br>

<?php echo $SmPagination->linkPager()?>