<?php
class Util {
	public static /*guid*/ function NewGuid() {
		$guid = "";
		for ($i = 0; $i < 32; ++$i)
			$guid .= dechex(rand(0,16));
		return $guid;
	}
	
	public static function PrintArray($array, $n = 0) {
		$s = "";
		for ($i = 0; $i < $n; ++$i)
			$s .= "&emsp;";
		foreach ($array as $k => $v) {
			if (is_array($v)) {
				echo "<p>$k";
				Util::PrintArray($v, $n+1);
				echo "</p>";
			}
			else
				echo "<p>$s$k => $v</p>";
		}
	}
}
?>