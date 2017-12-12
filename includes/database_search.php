<?php
/********
	***********************************
	php db functions
	***********************************
**********/
//----------------

class dbManagement{

	var $dbloc = 'local';
	
	var $dbhost;
	var $dbuser;
	var $dbpasswd;
	var $dbname;

    var $conn;

	var $link_db;
	var $link_select_db;
	var $query = '';

	var $st_towerco_tb = "db_st_towerco";

    /* audels added variables */
    var $query_id = 0;
    //number of rows affected by SQL query
    var $affected_rows = 0;


	function __construct(){
	
		switch ($this->dbloc){
		case 'local':
			$this->dbhost = 'localhost';
			$this->dbuser = 'root';
			$this->dbpasswd = '';
			$this->dbname = 'stimx';
			break;
		case 'cloud':
			$this->dbhost = '';
			$this->dbuser = '';
			$this->dbpasswd = '';
			$this->dbname = '';
			break;
		}
		
           $this->conn = new mysqli($this->dbhost, $this->dbuser, $this->dbpasswd, $this->dbname);

           if($this->conn->connect_errno)
           {
              echo "Could not connect to database.";
              return false;
           }
           else
           {
              return true;
           }
		   
		   
		  // from database2.php
		// $this->link_db = mysql_connect( $this->dbhost, $this->dbuser, $this->dbpasswd );
		
		// if ( !$this->link_db ) { echo "Could not connect to server."; return false; }
		
		// $this->link_select_db = mysql_select_db( $this->dbname, $this->link_db );
		// if( $this->link_select_db ){ 
			// return true;
		// }else{
			// echo "Could not connect to database.";
			// return false;
		// }		   
	}

	function table_exists ($table, $db) { 
           $res = $this->Query("SHOW TABLES LIKE $table");
           return mysql_num_rows($res) > 0;
        }

	function dbClose(){
           $this->conn->close();
	}
	
	// function dbClose(){
		// return mysql_close( $this->link_db );
	// }
	

	function getQuery( ){ return $this->query; }
	// function getQuery( ){ return $this->query; }

	// exeQuery in original files
	function exeQuery_original( $sql ){ 
		$this->query = $sql;
		return mysql_query( $sql ); 
	}
	
	function exeQuery2( $sql ){
		$this->query = $sql;
		return mysql_query( $sql ); 
	}	
	
	// modified exeQuery by John
	function exeQuery( $sql ){
                $this->query = $sql;
				
/* 		echo "Start <br/>"; 
		print_r($this->query);  echo "<br/>"; 
		echo "End <br/>"; */
		// seems following code does not work for glc_d
                return $this->conn->query( $sql );
	}
	
	// added from database2.php - not working, causing problems
	// function getNbrofRows($sql){
		// $quer4Data = $this->exeQuery2($sql);
		// $TblNbrRow = mysql_num_rows($quer4Data);
		// return $TblNbrRow; 
	// }	
	
	// added from database2.php - modified by Jiazhu Hu on 20140723
	function getNbrofRows($sql){
		// $quer4Data = $this->exeQuery2($sql);
		$this->query = $sql;
		// $TblNbrRow = mysql_num_rows($quer4Data);
		$result = $this->conn->query( $sql );
		
		$TblNbrRow= mysqli_num_rows($result);
		// $TblNbrRow = $this->conn->num_rows;
		return $TblNbrRow; 
	}	
	

	function getColumnNums( $sql ){ 
                $this->query = $sql;
                return $this->conn->field_count;
	}
	
	// function getColumnNums( $sql ){
		// $this->query = $sql;
		// return mysql_num_fields( $sql ); 
	// }		

	function getFieldList( $dbname, $tbname ){
                $qColumnNames = $this->conn->query("SHOW COLUMNS FROM " . $tbname) or die("mysql error");
                $numColumns = $qColumnNames->num_rows;
                $x = 0; 
                while ($x < $numColumns)
                {
                        $colname = $qColumnNames->fetch_row();
                        $col[] = $colname;
                        $x++;
                }
                return $col;
	}


	function exeSelectQuery( $table_name, $fields="", $filter = "", $sort_type = "", $other = ""){
		$order_by_sql	= "";
		$limit_sql		= "";
		$fields_select = $fields? "": "*";
		
		if( $fields ){
			foreach( $fields as $selected_fields ){ $fields_select .= $selected_fields.","; }
			$fields_select = substr( $fields_select, 0, -1 ); 
		}
		$where_sql = $filter? " WHERE ".$filter: "";

		if( $sort_type ){
			$sfiled		= $sort_type["sfiled"];
			$stype		= $sort_type["stype"] ? 'DESC': 'ASC';
			$limit_start = $sort_type["limit_start"];
			$limit_count = $sort_type["limit_count"];	

			$order_by_sql	= " ORDER BY ".$sfiled." ".$stype." ";
			if( $limit_start != "" || $limit_count != 0 )
				$limit_sql	= " LIMIT ".$limit_start.", ".$limit_count." ";
		}
		$this->query = "SELECT ".$fields_select." FROM ".$table_name.$where_sql." ".$order_by_sql." ".$limit_sql." ".$other;
		return $this->getResult( $this->query );
	}



	function getRowsList($tb_name, $STIMSiteID, $TwrID){
		$rows_list = array();
		$where = "STIMSiteID = '" . $STIMSiteID . "' AND TwrID = '" . $TwrID . "'";
		$lc_list = $this->exeSelectQuery( $tb_name, '', $where );
		for($i = 0; $i < count($lc_list); $i++){
			$index = 0;
			for($j = 0; $j < count($lc_list); $j++){
				if($lc_list[$i]['elevation'] == $lc_list[$j]['elevation'])
					$index++;
			}
			$rows_list[$lc_list[$i]['lc_id']] = $index;
			$index = 0;
		}
		return $rows_list;
	}

	function getRowsList1($tb_name, $STIMSiteID, $TwrID, $space = '', $glcxx = ''){
		$glc_detail_list = $this->getGLCDetailList($STIMSiteID,$TwrID);
		$rows_list = array();
		$where = "STIMSiteID = '" . $STIMSiteID . "' AND TwrID = '" . $TwrID . "'";
		$lc_list = $this->exeSelectQuery( $tb_name, '', $where );
		for($i = 0; $i < count($lc_list); $i++){
			$index = 0;
			for($j = 0; $j < count($lc_list); $j++){
				if($lc_list[$i]['elevation'] == $lc_list[$j]['elevation']){
					if($space != ''){
						if(isset($glc_detail_list[$lc_list[$j]['lc_id']][$glcxx])){
							$eqpt_num = $glc_detail_list[$lc_list[$j]['lc_id']][$glcxx]['eqpt_num'];
						}else{
							$eqpt_num = '';
						}
						if($eqpt_num != '')
							$index++;
					}else{
						$index++;
					}
				}
			}
			$rows_list[$lc_list[$i]['lc_id']] = $index;
			$index = 0;
		}
		return $rows_list;
	}



	function exeAddQuery( $table_name, $add_array ){
                $key_string = "(";
                $value_string = "(";
                foreach( $add_array as $key => $value ){
                        $key_string             .= $key.",";
                        $value_string   .= "'".trim($this->conn->real_escape_string($value))."',";
                }
                // $key_string     = substr( $key_string, 0, -1 ) . ", modifiedOn, modifiedBy" . ")";
                // $value_string   = substr( $value_string, 0, -1 ) . ", now()," . $_SESSION['user'] . ");";
                $key_string     = substr( $key_string, 0, -1 ) . ",createdOn, modifiedOn, modifiedBy" . ")";
                $value_string   = substr( $value_string, 0, -1 ) . ", now()" . ", now()," . $_SESSION['user'] . ");";				

                $this->query = "insert into $table_name ".$key_string." values ".$value_string;
				
				// echo "Start <br/>"; 
				// print_r($this->query);  echo "<br/>";
				// echo "End <br/>";
				
                return $this->exeQuery( $this->query );
	}

	function getInsertId(){
                return $this->conn->insert_id;
	}

	function exeDeleteQuery($table_name,$what){
		$where_statement = " where ";
		foreach( $what as $key => $value ){
			$where_statement .= $key."='".trim($value)."' and ";
		}
		$where_statement = substr( $where_statement, 0, -4 );
		$this->query = "delete from $table_name ".$where_statement;
		// print_r($this->query);
		return $this->exeQuery( $this->query );
	}

	function exeUpdateQuery($table_name,$update_array,$what){
		$key_null = 'IS NULL';
		$key_string = "(";
		$value_string = "(";
		$set_string = "";
		foreach( $update_array as $key => $value ){
			$set_string .= $key."='".trim( $value )."',";
		}
		$set_string	= substr( $set_string, 0, -1 );

                $set_string .= ", modifiedOn=now(), modifiedBy=" . $_SESSION['user'];

		$where_statement = " where ";
		foreach( $what as $key => $value ){
			//if($value == 'null')
			if($value === 'null')
				$where_statement .= $key." ".$key_null." and ";
			else
				$where_statement .= $key."='".trim( $value )."' and ";
		}
		$where_statement = substr( $where_statement, 0, -4 );

		$this->query = "update $table_name set ".$set_string." ".$where_statement;
		
 		// echo "Start <br/>"; 
		// print_r($this->query);  echo "<br/>"; 
		// echo "End <br/>"; 

		return $this->exeQuery( $this->query );
	}

	function exeAffected(){
                return $this->conn->affected_rows;
	}

	function getRows( $sql ){
                $result = $sql? $this->conn->query( $sql ): $this->conn->query( $this->query );
                return $result->num_rows;
	}

	function getResult($sql){
                $result = $this->exeQuery( $sql );
                $array = array();
                
                if( !$result ) { return array(); }
				
                if( $result->num_rows == 0 ){ return array(); }
                else{
                        $nameArray = array();
                        $j = 0;
                
                        $fn = $result->fetch_fields();
                                
                        while ( $j < $this->conn->field_count ) {
                        
                                //$nameArray[$j] = mysql_field_name( $result, $j );                                     
                                
                                $nameArray[$j] = $fn[$j]->name;
                                $j++;
                        }       
                        $i = 0; 
                        while( $row = $result->fetch_array(MYSQLI_ASSOC) /* mysql_fetch_array( $result ) */  ){
                                $r = 0; 
                                foreach( $nameArray as $name ){
                                        if( $name == "RNUM" ) continue;
                                        $array[$i][$name] = str_replace( "\n", "<br>", $row[$name] );
                                }
                                $i++;
                        }
                        return $array;

                }
                return $array;
	}
	


	function nnr_not_null( $value ){
	// This function is to 
		if ( is_array( $value ) ){
			if ( sizeof( $value ) > 0 ){
				return true;
			}else{
				return false;
			}
		}else{
			if ( ( $value != '') && ( strtolower( $value ) != 'null') && ( strlen( trim( $value ) ) > 0) ){
				return true;
			}else{
				return false;
			}
		}
	}

	function nnr_output_string( $string, $stripslashes = true, $translate = false, $protected = false ){
		if ( $protected == true ){
			$string = htmlspecialchars( $string, ENT_QUOTES );
		}else{
			if ( $translate == false ){
				$string =  strtr( trim( $string ), array ( '"' => '&quot;', '<br />' => '&nbsp;' ));
			}else{
				$string =  strtr( trim( $string ), $translate );
			}
		}
		if( $stripslashes ){
			return stripslashes( $string );
		}else{
			return $string;
		}
	}
	


	function addColumn($num, $tb_name){
		$isCol_slq = "SHOW COLUMNS FROM " . $tb_name . sprintf("%02d", $num) . " FROM " . $this->dbname;
		$res = $this->exeQuery($isCol_slq);
		if(!$res){
			$sql = "ALTER TABLE " . $tb_name . " ADD " . $this->glc_col . sprintf('%02d', $num) . " INT NOT NULL";
			$res = $this->exeQuery($sql);
			$sql = "ALTER TABLE " . $tb_name . " ADD " . $this->glc_col . sprintf('%02d', $num) . "_" . $this->eqptNum_col . " INT NOT NULL";
			$res = $this->exeQuery($sql);
		}
	}

	function getUnInputNum($tb_name){
		$sql = "select * from " . $tb_name . " where lc_lcnum = ''";
		$res = $this->exeQuery($sql);
                return $res->num_rows;
	}

	function deleteColumn($num, $tb_name){
		$sql = "ALTER TABLE " . $tb_name . " DROP " . $num . ", DROP " . $num . "_EqptNum";
		$this->exeQuery($sql);
	}


	function display_format_number ( $number, $point_num=0 ) {
		
		//echo str_repeat('0', $point_num);

		if ( strlen ( $number ) < 4 ) {
			return ( $number == 0 ) ? "" : round($number, $point_num);
		} else {
			if(strstr(number_format( $number,$point_num, '.', ' ' ), '.') == '.'.str_repeat('0', $point_num)){
				return substr(number_format( $number,$point_num, '.', ' ' ), 0, -(++$point_num));
			}else{
				return number_format( $number,$point_num, '.', ' ' );
			}
		}
	}

    /* audels added methods ******************************************************/
    /* audels added methods ******************************************************/
    /* audels added methods ******************************************************/

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
    #  executes SQL query to an open connection
    function query($sql) {
        // do query
         $this->query_id = @mysql_query($sql, $this->conn->thread_id);

        if (!$this->query_id) {
            $this->oops("<b>MySQL Query fail:</b> $sql");
            return 0;
        }

        $this->affected_rows = @mysql_affected_rows($this->conn->thread_id);

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
      <?php
    }

}

?>
