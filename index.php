<?php
/**
 * Converts SimpeXML object to JSON data when there is one child
 */
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

echo "<h1>The Problem</h2>";
$simpleXML = new SimpleXMLElement($inputXML);
echo json_encode($simpleXML, JSON_PRETTY_PRINT);

echo "\n\n";

$simpleXML = new SimpleXMLElement($inputXMLwithOneElement);
echo json_encode($simpleXML, JSON_PRETTY_PRINT);

echo "The Fix!";

class XML2JsonSearchResult extends SimpleXMLElement implements JsonSerializable
{
    public function jsonSerialize()
    {
//    var_dump($this); echo "+++ ";
    $name = $this->getName();
    $value = (array)$this;
        foreach ($this as $v)
        {
//           var_dump($v);

        }
        if (count($value) == 1)
            return [$value];
        return $value;    
  
    }
}

$SimpleXMLfixed = new XML2JsonSearchResult($inputXMLwithOneElement);

echo json_encode($SimpleXMLfixed, JSON_PRETTY_PRINT);
