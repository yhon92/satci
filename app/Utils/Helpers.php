<?php namespace SATCI\Utils;

/**
* 
*/
class Helpers
{
	
	static public function isCheck(&$request, $InputName)
	{
		if ($request[$InputName])
			return $request[$InputName] = true;
		else
			return $request[$InputName] = false;
	}
}