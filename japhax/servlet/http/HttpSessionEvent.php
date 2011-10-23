<?php
namespace japhax\servlet\http;

use japha\util\EventObject;

class HttpSessionEvent extends EventObject {
	public function __construct( HttpSession $source ) {
		$this->source = $source;
	}

	public function getSession() {
		return $this->source;
	}
}
