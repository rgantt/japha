<?
/**
 * $Id: config.php,v 1.5 2005/06/16 16:04:39 japha Exp $
 *
 * Japha configuration directives. The only required directive is the the classpath.
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.5 $
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
    "C:/htdocs/japha3",
    "C:/htdocs/intake",
    'C:/htdocs/blargon3',
    "C:/htdocs/jpunit",
    "C:/htdocs/"
);
?>