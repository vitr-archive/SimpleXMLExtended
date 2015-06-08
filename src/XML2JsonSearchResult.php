<?php

class XML2JsonSearchResult extends SimpleXMLElement implements JsonSerializable
{
    public function jsonSerialize()
    {
//    var_dump($this); echo "+++ ";
        $name = $this->getName();
        $value = (array)$this;
//    var_dump(array_values($value)[0]);
//    var_dump(reset($this));
        if (count($value) == 1)
//            return [$value];
            return [key($this) => [(array)reset($this)]];
        return $value;

    }
}