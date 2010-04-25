<?
/**
 * $Id$
 *
 * Japha configuration directives. The only required directive is the the classpath.
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */

/**
 * Each of these array entries refers to one path that the class files could be located in.
 *
 * If the class is found in the first path, then it is loaded. Otherwise, each path is searched for the class
 * until a match is found.
 *
 * @type String[]
 */
$classpath = array(
    "d:/wamp/www/japha",
    "d:/wamp/www/jpunit",
    "d:/wamp/www"
);
?>