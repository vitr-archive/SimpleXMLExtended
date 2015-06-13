[![Build Status](https://travis-ci.org/vitr/SimpleXmlToJsonSerializer.svg?branch=master)](https://travis-ci.org/vitr/SimpleXmlToJsonSerializer)

SimpleXml To Json Force Array / consider SimpleXMLExtended as it wil have another method to handle CDATA

# SimpleXml To Json Serializer
Better JSON serializer for php

Returns an array in json_encode result for only one nested element in SimpleXML object

inspired by http://stackoverflow.com/questions/16935560/php-convert-xml-to-json-group-when-there-is-one-child

https://hakre.wordpress.com/2013/07/10/simplexml-and-json-encode-in-php-part-iii-and-end/

run code
https://eval.in/378064

php can't have object properties with same name, therefore is uses arrays for xml like this
<list>
  <node>item1</node>
  <node>item2</node>
  ...
  <node>item9</node>
</list>  

testing tools: phpunit & phpspec