<?php 
class Sorting{
	//-----------  Associative-Associative Array  -----------
	public static function ASortAscending(&$myArray, $filter){
		uasort($myArray, function($array1, $array2) use ($filter){
			return $array1[$filter] < $array2[$filter]? -1 : 1;
		});
	}
	public static function ASortDescending(&$myArray, $filter){
		uasort($myArray, function($array1, $array2) use ($filter){
			return $array1[$filter] > $array2[$filter]? -1 : 1;
		});
	}
	//-----------  Indexed-Associative Array  -----------
	public static function SortAscending(&$myArray, $filter){
		usort($myArray, function($array1, $array2) use ($filter){
			return $array1[$filter] < $array2[$filter]? -1 : 1;
		});
	}
	public static function SortDescending(&$myArray, $filter){
		usort($myArray, function($array1, $array2) use ($filter){
			return $array1[$filter] > $array2[$filter]? -1 : 1;
		});
	}
}
?>