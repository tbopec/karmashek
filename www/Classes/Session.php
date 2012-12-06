<?php
require_once("DB.php");
require_once("Util.php");
class Session {
	/*
		Разница, при которой сессия считается протухшей
	*/
	private static /*int*/ $DifferenceToOld = 300;
	/*
		guid
	*/
	public /*guid*/ $Guid;
	/*
		User id
	*/
	public /*guid*/ $UserId;
	/*
		Date of last log in
	*/
	public /*DateTime*/ $LastLogIn;
	
	public function __construct() {
		$this->LastLogIn = date("Y-m-d H:i:s");
		$this->Guid = Util::NewGuid();
	}
	
	public static /*Session?*/ function Get(/*guid*/$guid) {
		$sql = DB::Get("sessions", "`guid`='$guid'", array('userId', "date_format(lastLogIn, '%d %M %Y, %H:%i') as date"));
		if (count($sql) == 0) return null;
		$sql = $sql[0];
		$sess = new Session();
		$sess->Guid = $guid;
		$sess->UserId = $sql['userId'];
		$sess->LastLogIn = date("Y-m-d H:i:s");
		return $sess;
	}
	
	public /*void*/ function Delete() {
		DB::Delete("sessions", "`guid`='{$this->Guid}'");
	}
	
	public /*void*/ function Save() {
		$this->Delete();
		$this->LastLogIn = date("Y-m-d H:i:s");
		DB::Insert("sessions", $this);
	}
	
	public /*bool*/ function IsOld() {
		$now = date("Y-m-d H:i:s");
		$diff = $now - $this->LastLogIn;
		$dif = $diff->y*30*24*60*60 + $diff->d*24*60*60 + $diff->h*60*60 + $diff->i*60 + $diff->s;
		return $dif > Session::$DifferenceToOld;
	}
}
?>