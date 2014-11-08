<?php
class dataAccess{
private  $host = "localhost";
private  $user = "root";
private  $pass = "";
private  $db_name = "atm";
private  $conn;
	function connect(){
	$this->conn = mysql_connect($this->host, $this->user, $this->pass);
    mysql_select_db($this->db_name);
  	if(!$this->conn){
	echo "<br> Not Connected to database";
	}
	

	}


	function disconnect($conn){
	mysql_close($conn);	
	}
    function __construct(){
        
        
    }
    function __destruct(){       
        
    }
    
    function insert($table,$fields,$values){
    $conn=$this->connect();
    $query="insert into " . $table ." (" .$fields .") values(". $values . ")";
	//echo "$query";
    $res=mysql_query($query);
	//if(!$res){echo "--propblem in insertion--";}
    $id=mysql_insert_id();
	return $id;
    }//end insert() and it will return value of autonumber field 



    function update($table,$update,$condition){
	$conn=$this->connect();
    $query="Update ". $table ." set ". $update ." where ". $condition;
	//echo $query;
    $res=mysql_query($query);   
 
        if(!$res){
        echo "<br><font color=red>Problem during Record updation.</font>";
        }  else {
        return true;
        }
	
    }//end update()


    function delete($table,$condition){
	$conn=$this->connect();
    $query="Delete from ". $table ." where ". $condition;
	//echo "--".$query."--";
    $res=mysql_query($query);    
        if(!$res){
        echo "<br><font color=red>Problem during Record deletion.</font>";
        }  else {
        return true;
        }
	}//end delete()

    function select($table,$fields,$condition='1',$groupby=''){
	$conn=$this->connect();
    $query="Select  ". $fields ." from ". $table ." where  ".$condition." ".$groupby;
	//echo "--$query--";
    $res=mysql_query($query);	
        if(!$res){
        echo "<br><font color=red>Problem during Record selection.</font>";
        }  else {
        return $res;
        }
	//$this->disconnect($conn);
    }//end select()

	function select_count($table,$fields,$groupby){
	$conn=$this->connect();
    $query="Select  ". $fields ." from ". $table ." Group By  ".$groupby;
	//echo "<br>query =$query";
    $res=mysql_query($query);
        if(!$res){
        //echo "<br><font color=red>Problem during Record selection.</font>";
        }  else {
        return $res;
        }
	$this->disconnect($conn);
    }//end select()*/
	
	function max_id_record($table,$condition){
	$conn=$this->connect();
    $query="Select MAX(id) From ". $table ."  where ". $condition;
    $res=mysql_query($query);   
		if($res && $row=mysql_fetch_array($res)){
			$query2="Select * from $table where id={$row[0]}";
			 $res2=mysql_query($query2);  
			 if($res2){
			 return $res2;
			 }
			
		}	
	return 0;
    }//end update()
	
    function alert($a){
	echo "<script langauge=\"javascript\">alert(\"".$a."\");</script>";
    }//end function
    function redirect($url)
    {
            echo "<script langauge=\"javascript\">window.location = '$url';</script>";
    }// function end
	
	function deleteDir($dir) {
   	$iterator = new RecursiveDirectoryIterator($dir);
   	foreach (new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::CHILD_FIRST) as $file) 
   	{
      if ($file->isDir()) {
         rmdir($file->getPathname());
      } else {
         unlink($file->getPathname());
      }
   }
   rmdir($dir);
	}
	
      
    function insertContent($page_name){
		$rs =  $this->select("pages p,contents c ","c.contents","p.id=c.page_id and p.page_name='$page_name' ");
if($row=mysql_fetch_array($rs)){
	$contents=$row['contents'];
	return $contents;
}
	}//end function
  
  	function stopDirectAccess($key,$value){
	if ($key != $value) { 
        die("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?><!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"en\" xml:lang=\"en\">
<head>
<title>Access forbidden!</title>
<link rev=\"made\" href=\"mailto:postmaster@localhost\" />
<style type=\"text/css\"><!--/*--><![CDATA[/*><!--*/ 
    body { color: #000000; background-color: #FFFFFF; }
    a:link { color: #0000CC; }
    p, address {margin-left: 3em;}
    span {font-size: smaller;}
/*]]>*/--></style>
</head>
<body>
<h1>Access forbidden!</h1>
<p>
    You don't have permission to access the requested object.
    It is either read-protected or not readable by the server.
</p>
<p>
If you think this is a server error, please contact
the <a href=\"mailto:postmaster@localhost\">webmaster</a>.
</p>
<h2>Error 403</h2>
<address>
  <a href=\"/\">localhost</a><br />
  <span>1/20/2011 11:54:26 PM<br />
  Apache/2.2.14 (Win32) DAV/2 mod_ssl/2.2.14 OpenSSL/0.9.8l mod_autoindex_color PHP/5.3.1 mod_apreq2-20090110/2.7.1 mod_perl/2.0.4 Perl/v5.10.1</span>
</address>
</body>
</html>
"); //end die statement
}//end if
	}
  
}//end class dataAccess

//$obj=new dataAccess();
//echo $obj->insertImage("home","right1");
//echo $obj->insertContent("home","content1");


?>