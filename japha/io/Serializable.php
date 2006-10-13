<?
package("japha.io");

/**
 * $Id: Serializable.php,v 1.3 2004/07/14 22:27:03 japha Exp $
 *
 * Serializability of a class is enabled by the class implementing the java.io.Serializable 
 * interface. Classes that do not implement this interface will not have any of their 
 * state serialized or deserialized. All subtypes of a serializable class are themselves 
 * serializable. The serialization interface has no methods or fields and serves only to 
 * identify the semantics of being serializable. 
 *
 * To allow subtypes of non-serializable classes to be serialized, the subtype may assume 
 * responsibility for saving and restoring the state of the supertype's public, protected, 
 * and (if accessible) package fields. The subtype may assume this responsibility only if 
 * the class it extends has an accessible no-arg constructor to initialize the class's state. 
 * It is an error to declare a class Serializable if this is not the case. 
 * The error will be detected at runtime. 
 *
 * During deserialization, the fields of non-serializable classes will be initialized using 
 * the public or protected no-arg constructor of the class. 
 * A no-arg constructor must be accessible to the subclass that is serializable. 
 * The fields of serializable subclasses will be restored from the stream. 
 *
 * When traversing a graph, an object may be encountered that does not support the Serializable 
 * interface. In this case the NotSerializableException will be thrown and will identify the 
 * class of the non-serializable object. 
 *
 * Classes that require special handling during the serialization and deserialization process 
 * must implement special methods with these exact signatures: 
 * 
 * <code>private void writeObject(java.io.ObjectOutputStream out)
 *    throws IOException
 * private void readObject(java.io.ObjectInputStream in)
 *    throws IOException, ClassNotFoundException;</code>
 *
 * The writeObject method is responsible for writing the state of the object for its particular 
 * class so that the corresponding readObject method can restore it. 
 * The default mechanism for saving the Object's fields can be invoked by calling 
 * out.defaultWriteObject. The method does not need to concern itself with the state belonging 
 * to its superclasses or subclasses. State is saved by writing the individual fields to 
 * the ObjectOutputStream using the writeObject method or by using the methods for primitive data 
 * types supported by DataOutput. 
 * 
 * The readObject method is responsible for reading from the stream and restoring the classes fields. 
 * It may call in.defaultReadObject to invoke the default mechanism for restoring the object's 
 * non-static and non-transient fields. The defaultReadObject method uses information in the 
 * stream to assign the fields of the object saved in the stream with the correspondingly named 
 * fields in the current object. This handles the case when the class has evolved to add new fields. 
 * The method does not need to concern itself with the state belonging to its superclasses 
 * or subclasses. State is saved by writing the individual fields to the ObjectOutputStream using 
 * the writeObject method or by using the methods for primitive data types supported by DataOutput. 
 * 
 * Serializable classes that need to designate an alternative object to be used when writing an 
 * object to the stream should implement this special method with the exact signature: 
 *
 *
 * <code>ANY-ACCESS-MODIFIER Object writeReplace() throws ObjectStreamException;</code>
 *
 * This writeReplace method is invoked by serialization if the method exists and it would be 
 * accessible from a method defined within the class of the object being serialized. Thus, the 
 * method can have private, protected and package-private access. Subclass access to this 
 * method follows java accessibility rules. 
 *
 * Classes that need to designate a replacement when an instance of it is read from the stream 
 * should implement this special method with the exact signature.
 *
 * <code>ANY-ACCESS-MODIFIER Object readResolve() throws ObjectStreamException;</code>
 *
 * This readResolve method follows the same invocation rules and accessibility rules as writeReplace. 
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.3 $ $Date: 2004/07/14 22:27:03 $
 */
interface _Serializable
{
}
?>