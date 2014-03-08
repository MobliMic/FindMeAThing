<?php

	/**
	 * Trait HC_EscapeTrait
	 */
	trait HC_EscapeTrait {

		private function escapeTrait($string)
		{
			if (strpos($string,'"') !== false) {
				$string =  str_replace('"','&quot;',$string);
			}
			if (strpos($string,'\'') !== false) {
				$string =  str_replace('\'','\\\'',$string);
			}
			return $string;
		}
	}
