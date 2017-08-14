<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1252">
<TITLE>Session PHP Page</TITLE>
</HEAD>
<BODY>
<H1>Menu Example</h1>

<?php 
    $headers = array(                  
            'Header1' => 'menu.php?s=1',                  
            'Header2' => 'menu.php?s=2',                  
            'Header3' => 'menu.php?s=3'                  
            ); 

    $sub_1 = array( 
            'SubHeader1' => 'http://pear.php.net', 
            'SubHeader2' => 'http://www.zend.com', 
            'SubHeader3' => 'http://www.php.net' 
            ); 

    $sub_2 = array(             
            'SubHeader1' => 'http://www.perdue.net', 
            'Layer_example' => 'menu.php?s=2&b=1', 
            'SubHeader3' => 'http://www.sourceforge.net' 
            ); 

    $sub_2_layer = array(             
            'SubSubHeader1' => 'http://www.zend.com/',     
            'SubSubHeader2' => 'http://www.php.net',     
            'SubSubHeader3' => 'http://smarty.php.net' 
            ); 

    $sub_3 = array(             
            'SubHeader1' => 'http://www.fastsearch.com',     
            'SubHeader2' =>'http://www.alltheweb.com',     
            'SubHeader3' => 'http://www.gravitonic.com' 
            ); 

foreach ( $headers as $key => $value ) { 
        echo "<a href='$value'>$key</a><br>\n"; 
        if (($key == "Header1") && ($_GET["s"] == "1")) { 
                foreach ( $sub_1 as $key => $value ) { 
                        echo "<ul><a href='$value'>$key</a></ul>\n"; } 
        }
        
        else if (($key == "Header2") && ($_GET["s"] == "2")) { 
                foreach ( $sub_2 as $key => $value ) { 
                        echo "<ul><a href='$value'>$key</a></ul>\n"; 
                        if (($key == "Layer_example") && ($_GET["s"] == "2") && ($_GET["b"] == "1")) 
                        { 
                                foreach ( $sub_2_layer as $key => $value ) 
                                { 
                                        echo "<ul><ul><a href='$value'>$key</a></ul></ul>\n"; 
                                        if ($key == "SubSubHeader3") {$b = "2";} 
                                } 
                        } 
                } 
        } 

        else if (($key == "Header3") && ($_GET["s"] == "3")) { 
                foreach ( $sub_3 as $key => $value ) { 
                        echo "<ul><a href='$value'>$key</a></ul>\n"; } 
        } 
} 
?> 

</BODY>
</HTML>