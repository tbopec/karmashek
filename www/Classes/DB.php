<?php
class DB {
	private static /*string*/ $login = "root";
	private static /*string*/ $password = "123";
	private static /*string*/ $dbname = "karmashek";
	
	private static /*mysqli*/ function GetConnection() {
		return new mysqli("127.0.0.1", DB::$login, DB::$password, DB::$dbname);
	}
	
	public static /*void*/ function Insert(/*string*/$table, /*hash*/$obj) {
		$names = "";
		$vals = "";
		foreach ($obj as $k => $v) {
			$names .= ", $k";
			$vals .= ", '$v'";
		}
		$names = substr($names, 1);
		$vals = substr($vals, 1);
		$sql = DB::GetConnection();
		//echo "insert into $table ($names) values ($vals);";
		$res = $sql->query("insert into $table ($names) values ($vals);");
		$sql->close();
	}
	
	public static /*void*/ function Delete(/*string*/$table, /*string*/ $where) {
		if (strlen($where) > 0)
			$where = "where $where";
		else return;
		$sql = DB::GetConnection();
		$res = $sql->query("delete from $table $where");
		$sql->close();
	}
	
	public static /*hash*/ function Get(/*string*/ $table, /*string*/ $where = "", /*array*/$fields=array()) {
		$result = array();
		$flds = "*";
		if (strlen($where) > 0)
			$where = "where $where";
		if (isset($fields) && count($fields) > 0) {
			$flds = "";
			foreach ($fields as $f)
				$flds .= ", $f";
			$flds = substr($flds, 1);
		}
		$sql = DB::GetConnection();
		$res = $sql->query("select $flds from $table $where");
		$i = 0;
		if ($res) {
			while ($row = $res->fetch_object()) {
				$result[$i] = array();
				foreach ($row as $k => $v) {
					$result[$i][$k] = $v;
				}
				$i++;
			}
		}
		$sql->close();
		return $result;
	}
}
?>