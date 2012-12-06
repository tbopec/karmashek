<?php
require_once("DB.php");
require_once("Util.php");
class Preview {
	/*
		guid
	*/
	public /*guid*/ $Guid;
	/*
		Date of last log in
	*/
	public /*byte[]*/ $Data;
	
	public function __construct() {
		$this->Guid = Util::NewGuid();
	}
	
	public static /*Preview?*/ function Get(/*guid*/$guid) {
		$sql = DB::Get("previews", "`guid`='$guid'");
		if (count($sql) == 0) return null;
		$sql = $sql[0];
		$sess = new Preview();
		$sess->Guid = $guid;
		$sess->Data = base64_decode($sql['data']);
		return $sess;
	}
	
	public /*void*/ function Delete() {
		DB::Delete("previews", "`guid`='{$this->Guid}'");
	}
	
	public /*void*/ function Save() {
		$this->Delete();
		DB::Insert("previews", $this);
	}
}
?>