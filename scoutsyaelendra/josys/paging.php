<?php

/**
 * @link: http://www.Awcore.com/dev
 */
 
   function pagination($query, $per_page = 10,$page = 1, $url = '?'){        
    	$query = "SELECT COUNT(*) as `num` FROM {$query}";
    	$row = mysql_fetch_array(mysql_query($query));
    	$total = $row['num'];
        $adjacents = "2"; 

    	$page = ($page == 0 ? 1 : $page);  
    	$start = ($page - 1) * $per_page;								
		
    	$prev = $page - 1;							
    	$next = $page + 1;
        $lastpage = ceil($total/$per_page);
    	$lpm1 = $lastpage - 1;
    	
    	$pagination = "";
    	if($lastpage > 1)
    	{	
    		$pagination .= "";
                  //  $pagination .= "<li class='details'>Page $page of $lastpage";
    		if ($lastpage < 7 + ($adjacents * 2))
    		{	
    			for ($counter = 1; $counter <= $lastpage; $counter++)
    			{
    				if ($counter == $page)
    					$pagination.= "<a class='current'>$counter</a> | ";
    				else
    					$pagination.= "<a href='{$url}page=$counter'>$counter</a> | ";					
    			}
    		}
    		elseif($lastpage > 5 + ($adjacents * 2))
    		{
    			if($page < 1 + ($adjacents * 2))		
    			{
    				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<a class='current'>$counter</a> | ";
    					else
    						$pagination.= "<a href='{$url}page=$counter'>$counter</a> | ";					
    				}
    				$pagination.= "... | ";
    				$pagination.= "<a href='{$url}page=$lpm1'>$lpm1</a> | ";
    				$pagination.= "<a href='{$url}page=$lastpage'>$lastpage</a> | ";		
    			}
    			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
    			{
    				$pagination.= "<a href='{$url}page=1'>1</a> | ";
    				$pagination.= "<a href='{$url}page=2'>2</a> | ";
    				$pagination.= "... | ";
    				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<a class='current'>$counter</a> | ";
    					else
    						$pagination.= "<a href='{$url}page=$counter'>$counter</a> | ";					
    				}
    				$pagination.= ".. |  ";
    				$pagination.= "<a href='{$url}page=$lpm1'>$lpm1</a> |  ";
    				$pagination.= "<a href='{$url}page=$lastpage'>$lastpage</a> |  ";		
    			}
    			else
    			{
    				$pagination.= "<a href='{$url}page=1'>1</a> |  ";
    				$pagination.= "<a href='{$url}page=2'>2</a> | ";
    				$pagination.= "..";
    				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<a class='current'>$counter</a> | ";
    					else
    						$pagination.= "<a href='{$url}page=$counter'>$counter</a> | ";					
    				}
    			}
    		}
    		
    		if ($page < $counter - 1){ 
    			//$pagination.= "<a href='{$url}page=$next'>Next</a>";
               // $pagination.= "<a href='{$url}page=$lastpage'>Last</a>";
    		}else{
    			//$pagination.= "<a class='current'>Next</a>";
                //$pagination.= "<a class='current'>Last</a>";
            }
    		$pagination.= "</ul>\n";		
    	}
    
    
        return $pagination;
    } 
?>
