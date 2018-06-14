<?
class FormProc {  

function add($table,$missing,$insert='') {
  GLOBAL $_POST, $db;
  if (!is_array($insert)) $insert = $_POST;
  $query = "INSERT INTO $table (";
  $bval = "";
  $hval = "";
  foreach ($insert as $key => $val) {
    if (in_array($key,$missing)) continue;
	$bval .= "$key, ";
	$hval .= "'$val', ";
  }
  $query .= substr($bval, 0, -2).") VALUES (".substr($hval, 0, -2).")";
  $result = $db -> query($query);
  RETURN $result;
}

  function del($table,$where) {
	GLOBAL $_POST, $db;

	if(is_array($where)) {
	  foreach ($where as $key => $val) {
		$wval .= "$key = $val, ";
	  }
	}
	$query = "DELETE FROM $table WHERE ".substr($wval, 0, -2);
	$result = $db -> query($query);
	RETURN $result;
  }

  function update($table,$missing,$where,$data=array()) {
	GLOBAL $_POST, $db;
  if (!isset ($wval))  $wval="";
	if(empty($data)) $data = $_POST;
	$query = "UPDATE $table SET ";
    foreach ($data as $key => $val) {
  	  if (in_array($key,$missing)) continue;
	  $query .= "$key = '$val', ";
	}
	if(is_array($where)) {
	  foreach ($where as $key => $val) {
		$wval .= "$key = $val AND ";
	  }
	}
    $query = substr($query, 0, -2)." WHERE ".substr($wval, 0, -5);
	$result = $db -> query($query);
	RETURN $result;
  }



}
?>
