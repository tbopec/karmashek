<?php
require_once("settings.php");
require_once("Util.php");
require_once("DB.php");
require_once("Session.php");
class User {
	/*
		guid
	*/
	public /*guid*/ $Guid;
	/*
		login
	*/
	public /*string*/ $Login;
	
	/*
		md5(password)
	*/
	public /*~guid*/ $Password;
	/*
		F
	*/
	public /*string*/ $Family;
	/*
		Name
	*/
	public /*string*/ $Name;
	
	public function __construct() {
		$this->Guid = Util::NewGuid();
	}
	
	public static /*User?*/ function GetByLoginPass($login, $pass) {
		$p = md5($pass);
		$u = DB::Get("users", "`login`='$login'", array("password", "guid"));
		if (count($u) == 0) return 0;
		if (count($u) > 1) return -1;
		if ($u[0]['password'] != $p) return -2;
		return User::Get($u[0]["guid"]);
	}
	
	/*
		Get User by guid
	*/
	public static /* User? */ function Get(/*guid*/ $guid) {
		$userFields = DB::Get("users", "`guid`='$guid'");
		if (count($userFields) == 0)
			return null;
		$userFields = $userFields[0];
		$u = new User();
		$u->Guid = $userFields['guid'];
		$u->Login = $userFields['login'];
		$u->Password = $userFields['password'];
		$u->Family = $userFields['Family'];
		$u->Name = $userFields['Name'];
		return $u;
	}
	
	public static /* User? */ function GetUserBySession(/*guid*/$session) {
		$sess = Session::Get($session);
		if ($sess == null) return null;
		if ($sess->IsOld())
		{
			$sess->Delete();
			return null;
		} else {
			$u = User::Get($sess->UserId);
			if ($u != null)
				$sess->Save();
			return $u;
		}
	}
	
	public function Delete() {
		DB::Delete("users","`guid`='{$this->Guid}'");
		DB::Delete("sessions","`userId`='{$this->Guid}'");
	}
	
	public function Save() {
		DB::Delete("users","`guid`='{$this->Guid}'");
		DB::Insert("users", $this);
	}
	
	public function StartSession() {
		DB::Delete("sessions", "`userId`='{$u->Guid}'");
		$sess = new Session();
		$sess->Guid = session_id();
		$sess->UserId = $this->Guid;
		$sess->Save();
		session_start();
	}
}
?>