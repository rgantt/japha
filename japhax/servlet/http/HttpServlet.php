<?php
namespace japhax\servlet\http;

use japhax\servlet\GenericServlet;
use japha\io\_Serializable;

abstract class HttpServlet extends GenericServlet implements _Serializable {
	abstract protected function doDelete( HttpServletRequest $req, HttpServletResponse $resp );
	abstract protected function doGet( HttpServletRequest $req, HttpServletResponse $resp );
	abstract protected function doHead( HttpServletRequest $req, HttpServletResponse $resp );
	abstract protected function doOptions( HttpServletRequest $req, HttpServletResponse $resp );
	abstract protected function doPost( HttpServletRequest $req, HttpServletResponse $resp );
	abstract protected function doPut( HttpServletRequest $req, HttpServletResponse $resp );
	abstract protected function doTrace( HttpServletRequest $req, HttpServletResponse $resp );
	abstract protected function getLastModified( HttpServletRequest $req );
	//abstract protected function service( HttpServletRequest $req, HttpServletResponse $resp );
}