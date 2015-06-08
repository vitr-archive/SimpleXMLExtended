<?php
/**
 * Converts SimpleXML object to JSON data when there is one child
 */


ini_set('xdebug.var_display_max_depth', -1);
ini_set('xdebug.var_display_max_children', -1);
ini_set('xdebug.var_display_max_data', -1);

$inputXML = <<<STRING
<?xml version="1.0" encoding="UTF-8"?>
<result>
<status>ok</status>
<productlist>
    <product>
        <id>1</id>
        <name>Prod1</name>
    </product>
    <product>
        <id>2</id>
        <name>Prod1</name>
    </product>
    <product>
        <id>3</id>
        <name>Prod1</name>
    </product>
</productlist>
</result>
STRING;


$inputXMLwithOneElement = <<<STRING
<?xml version="1.0" encoding="UTF-8"?>
<result>
<status>ok</status>
<productlist>
    <product>
        <id>1</id>
        <name>Prod1</name>
    </product>
</productlist>
</result>
STRING;
$inputXMLwithOneElement2 = <<<STRING
<?xml version="1.0" encoding="UTF-8"?>
<result>
<status>ok</status>
<productlist>
    <product>
        <id>123</id>
        <name>Prod132</name>
    </product>
</productlist>
</result>
STRING;

//echo "<pre>";
//echo "<h1>The Problem</h2>";
$simpleXML = new SimpleXMLElement($inputXML);
//echo json_encode($simpleXML, JSON_PRETTY_PRINT);
var_dump(json_decode(json_encode($simpleXML), true));
echo "\n\n";

$simpleXML = new SimpleXMLElement($inputXMLwithOneElement);
//echo json_encode($simpleXML, JSON_PRETTY_PRINT);
var_dump(json_decode(json_encode($simpleXML), true));

//echo "See, if I have only one product in the list, it isn't in array any more. I want these bruckets []";
//
//echo "The Fix!";

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

$SimpleXMLfixed = new XML2JsonSearchResult($inputXMLwithOneElement2);

//echo json_encode($SimpleXMLfixed, JSON_PRETTY_PRINT);
var_dump(json_decode(json_encode($SimpleXMLfixed), true));
//json_decode(json_encode($SimpleXMLfixed), true);
