<?php
/**
 * Class JsonXMLElement.
 *
 * The following boilerplate code shows how to implement such a serialization.
 * In this example, the standard array casting is used
 * This is really only boilerplate code because having such an implementation will encode the JSON exactly
 * as it had been done before. With those exact same characteristics.
 */
class JsonXMLElement extends SimpleXMLElement implements JsonSerializable
{
    /**
     * Specify data which should be serialized to JSON.
     *
     * @return mixed data which can be serialized by json_encode.
     */
    public function jsonSerialize()
    {
        return (object) (array) $this;
    }
}
