 <?php
//$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
class Database {
var $server   = "localhost"; //database server
var $user     = "root"; //database login name
var $pass     = ""; //database login password
var $database = "stmix"; //database name
var $pre      = ""; //table prefix



//internal info
var $error = "";
var $errno = 0;

//number of rows affected by SQL query
var $affected_rows = 0;

var $link_id = 0;
var $query_id = 0;



# constructor
function Database($server='', $user='', $pass='', $database='', $pre=''){
 }

#  connect and select database using vars above
function connect($new_link=false) {
    echo "sad";
    $this->link_id=@mysql_connect($this->server,$this->user,$this->pass,$this->database);

    if (!$this->link_id) {//open failed
        $this->oops("Could not connect to server: <b>$this->server</b>.");
        }

    if(!@mysql_select_db($this->database, $this->link_id)) {//no database
        $this->oops("Could not open database: <b>$this->database</b>.");
        }

    // unset the data so it can't be dumped
    $this->server='';
    $this->user='';
    $this->pass='';
    $this->database='';
}


#  close the connection
function close() {
    if(!@mysql_close($this->link_id)){
        $this->oops("Connection close failed.");
    }
}


# escapes characters to be mysql ready
function escape($string) {
    if(get_magic_quotes_runtime()) $string = stripslashes($string);
    return @mysql_real_escape_string($string,$this->link_id);
}


#  executes SQL query to an open connection
function query($sql) {
    // do query
    $this->query_id = @mysql_query($sql, $this->link_id);

    if (!$this->query_id) {
        $this->oops("<b>MySQL Query fail:</b> $sql");
        return 0;
    }
    
    $this->affected_rows = @mysql_affected_rows($this->link_id);
    return $this->query_id;
}


# fetches and returns results one line at a time
function fetch_array($query_id=-1) {
    // retrieve row
    if ($query_id!=-1) {
        $this->query_id=$query_id;
    }

    if (isset($this->query_id)) {
        $record = @mysql_fetch_assoc($this->query_id);
    }else{
        $this->oops("Invalid query_id: <b>$this->query_id</b>. Records could not be fetched.");
    }

    return $record;
}



# returns all the results (not one row)
function fetch_all_array($sql) {
    $query_id = $this->query($sql);
    $out = array();

    while ($row = $this->fetch_array($query_id)){
        $out[] = $row;
    }

    $this->free_result($query_id);
    return $out;
}


#  frees the resultset
# param: query_id for mysql run. if none specified, last used
function free_result($query_id=-1) {
    if ($query_id!=-1) {
        $this->query_id=$query_id;
    }
    if($this->query_id!=0 && !@mysql_free_result($this->query_id)) {
        $this->oops("Result ID: <b>$this->query_id</b> could not be freed.");
    }
}



# desc: does a query, fetches the first row only, frees resultset

function query_first($query_string) {
    $query_id = $this->query($query_string);
    $out = $this->fetch_array($query_id);
    $this->free_result($query_id);
    return $out;
}#-#query_first()



# does an update query with an array
function query_update($table, $data, $where='1') {
    $q="UPDATE `".$this->pre.$table."` SET ";

    foreach($data as $key=>$val) {
        if(strtolower($val)=='null') $q.= "`$key` = NULL, ";
        elseif(strtolower($val)=='now()') $q.= "`$key` = NOW(), ";
        elseif(preg_match("/^increment\((\-?\d+)\)$/i",$val,$m)) $q.= "`$key` = `$key` + $m[1], "; 
        else $q.= "`$key`='".$this->escape($val)."', ";
    }

    $q = rtrim($q, ', ') . ' WHERE '.$where.';';

    return $this->query($q);
}



# does an insert query with an array
# param: table (no prefix), assoc array with data
# returns: id of inserted record, false if error 
function query_insert($table, $data) {
    $q="INSERT INTO `".$this->pre.$table."` ";
    $v=''; $n='';

    foreach($data as $key=>$val) {
        $n.="`$key`, ";
        if(strtolower($val)=='null') $v.="NULL, ";
        elseif(strtolower($val)=='now()') $v.="NOW(), ";
        else $v.= "'".$this->escape($val)."', ";
    }

    $q .= "(". rtrim($n, ', ') .") VALUES (". rtrim($v, ', ') .");";

    if($this->query($q)){
        //$this->free_result();
        return mysql_insert_id($this->link_id);
    }
    else return false;

}



#  throw an error message
function oops($msg='') {
    if($this->link_id>0){
        $this->error=mysql_error($this->link_id);
        $this->errno=mysql_errno($this->link_id);
    }
    else{
        $this->error=mysql_error();
        $this->errno=mysql_errno();
    }
    ?>
        <table align="center" border="1" cellspacing="0" style="background:white;color:black;width:80%;">
        <tr><th colspan=2>Database Error</th></tr>
        <tr><td align="right" valign="top">Message:</td><td><?php echo $msg; ?></td></tr>
        <?php if(!empty($this->error)) echo '<tr><td align="right" valign="top" nowrap>MySQL Error:</td><td>'.$this->error.'</td></tr>'; ?>
        <tr><td align="right">Date:</td><td><?php echo date("l, F j, Y \a\\t g:i:s A"); ?></td></tr>
        <?php if(!empty($_SERVER['REQUEST_URI'])) echo '<tr><td align="right">Script:</td><td><a href="'.$_SERVER['REQUEST_URI'].'">'.$_SERVER['REQUEST_URI'].'</a></td></tr>'; ?>
        <?php if(!empty($_SERVER['HTTP_REFERER'])) echo '<tr><td align="right">Referer:</td><td><a href="'.$_SERVER['HTTP_REFERER'].'">'.$_SERVER['HTTP_REFERER'].'</a></td></tr>'; ?>
        </table>
    <?php
}


}

?> 