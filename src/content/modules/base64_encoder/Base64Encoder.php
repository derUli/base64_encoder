<?php
class Base64Encoder extends Controller {
	private $moduleName = "base64_encoder";
	public function contentFilter($html) {
		preg_match_all ( "/\[base64](.+)\[\/base64]/", $html, $match );
		
		if (count ( $match ) > 0) {
			for($i = 0; $i < count ( $match [0] ); $i ++) {
				$placeholder = $match [0] [$i];
				$value = unhtmlspecialchars ( $match [1] [$i] );
				$value = base64_encode ( $value );
				$html = str_replace ( $placeholder, $value, $html );
			}
		}
		return $html;
	}
	public function getSettingsHeadline() {
		return get_translation ( "base64_encoder" );
	}
	public function getSettingsLinkText() {
		return get_translation ( "open" );
	}
	public function settings() {
		if (Request::hasVar ( "mode" ) and Request::hasVar ( "input" )) {
			ViewBag::set ( "input", Request::getVar ( "input" ) );
			switch (Request::getVar ( "mode", "encode" )) {
				case "decode" :
					ViewBag::set ( "output", base64_decode ( request::getVar ( "input" ) ) );
					break;
				case "encode" :
				default :
					ViewBag::set ( "output", base64_encode ( request::getVar ( "input" ) ) );
					break;
					break;
			}
		}
		return Template::executeModuleTemplate ( $this->moduleName, "encoder.php" );
	}
}