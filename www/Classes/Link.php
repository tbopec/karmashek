<?php
require_once("Preview.php");
require_once("DB.php");
require_once("Util.php");
class Link {
	/*
		guid
	*/
	public /*guid*/ $Guid;
	/*
		User id
	*/
	public /*guid*/ $Owner;
	/*
		Parent
	*/
	public /*guid*/ $Parent;
	/*
		Date of last log in
	*/
	public /*DateTime*/ $Date;
	
	/*
		Name
	*/
	public /*string*/ $Name;
	/*
		Info
	*/
	public /*string*/ $Info;
	/*
		Guid of preview
	*/
	public /*guid*/ $Preview;
	/*
		is folder?
	*/
	public /*bool*/ $IsFolder;
	
	public /*int*/ $ChildCount;
	
	private function __construct() {
		$this->Date = date("Y-m-d H:i:s");
		$this->Guid = Util::NewGuid();
		$this->ChildCount = 0;
	}
	
	public static /*Link?*/ function Get(/*guid*/$guid) {
		$sql = DB::Get("links", "`guid`='$guid'");
		if (count($sql) == 0) return null;
		$sql = $sql[0];
		$link = new Link();
		$link->Guid = $guid;
		$link->Owner = $sql['owner'];
		$link->Parent = $sql['parent'];
		$link->Date = date("Y-m-d H:i:s");
		$link->Preview = $sql['preview'];
		$link->Name = base64_decode($sql['name']);
		$link->Info = base64_decode($sql['info']);
		$link->IsFolder = $sql['isfolder'] != 0;
		if ($link->IsFolder)
		{
			$cnt = DB::Get("links", "`parent`='$guid'", array('count(*) as cnt'));
			$link->ChildCount = $cnt[0]['cnt'];
		}
		return $link;
	}
	
	public /*void*/ function Delete() {
		DB::Delete("links", "`guid`='{$this->Guid}'");
	}
	
	public /*void*/ function Save() {
		$this->Delete();
		$tmpInfo = $this->Info;
		$this->Info = base64_encode($tmpInfo);
		$tmpName = $this->Name;
		$this->Name = base64_encode($tmpName);
		DB::Insert("links", $this);
		$this->Info = $tmpInfo;
		$this->Name = $tmpName;
	}
	
	public /*Link[]*/ function GetForParent(/*guid*/$parent) {
		$sql = DB::Get("links", "`parent`='$parent'", array('guid'));
		$res = array();
		foreach ($sql as $guid) {
			$res[] = Link::Get($guid['guid']);
		}
		return $res;
	}
	
	public static /*Link*/ function Create(/*guid*/$parent, /*guid*/$owner, /*string*/$name, /*string*/$info, /*byte[]*/ $file) {
		$link = new Link();
		$link->Owner = $owner;
		$link->Parent = $parent;
		$link->Name = $name;
		$link->Info = $info;
		$link->IsFolder = 0;
		$link->Save();
		if ($file != "") {
			$preview = new Preview();
			$preview->Data = base64_encode($file);
			$preview->Save();
			$link->Preview = $preview->Guid;
			$link->Save();
		}
		return $link;
	}
	public static /*Link*/ function CreateFolder(/*guid*/$parent, /*guid*/$owner, /*string*/$name, /*string*/$info) {
		$link = new Link();
		$link->Owner = $owner;
		$link->Parent = $parent;
		$link->Name = $name;
		$link->Info = $info;
		$link->IsFolder = 1;
		$link->Save();
		return $link;
	}
}
?>