<?php
package("japha.lang");

/**
 * $Id$
 *
 * The Runtime.exec methods create a native process and return an instance of a subclass of Process that can be used 
 * to control the process and obtain information about it. The class Process provides methods for performing 
 * input from the process, performing output to the process, waiting for the process to complete, 
 * checking the exit status of the process, and destroying (killing) the process.
 *
 * The Runtime.exec methods may not work well for special processes on certain native platforms, such 
 * as native windowing processes, daemon processes, Win16/DOS processes on Microsoft Windows, or shell scripts. 
 * The created subprocess does not have its own terminal or console. All its standard io (i.e. stdin, stdout, stderr) 
 * operations will be redirected to the parent process through three streams 
 * (Process.getOutputStream(), Process.getInputStream(), Process.getErrorStream()). 
 * The parent process uses these streams to feed input to and get output from the subprocess. 
 * Because some native platforms only provide limited buffer size for standard input and output streams, 
 * failure to promptly write the input stream or read the output stream of the subprocess may cause the subprocess 
 * to block, and even deadlock.
 *
 * The subprocess is not killed when there are no more references to the Process object, but rather the subprocess continues executing asynchronously.
 *
 * There is no requirement that a process represented by a Process object execute asynchronously 
 * or concurrently with respect to the Java process that owns the Process object. 
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
abstract class Process extends Object
{
	public function __construct(){}
	
	abstract public function destroy();
	abstract public function exitValue();
	abstract public function getErrorStream();
	abstract public function getInputStream();
	abstract public function getOutputStream();
	abstract public function waitFor();
}
?>