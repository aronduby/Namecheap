<?php

namespace Namecheap;

/**
 * This class handles a namecheap API response
 */
class Response
{

	/**
	 * Was the request successful
	 *
	 * @var
	 */
	public $success;

	/**
	 * The raw xml string response
	 *
	 * @var string
	 */
	private $raw;

	/**
	 * The SimpleXMLElement response
	 *
	 * @var \SimpleXMLElement
	 */
	private $xml;

	/**
	 * An array representing the request sent to get this response
	 *
	 * @var array
	 */
	private $request;

	/**
	 * @var ParserOptions
	 */
	private $parser_options;
	

	public function __construct($response, array $request, ParserOptions $parser_options)
	{
		$this->raw            = $response;
		$this->request        = $request;
		$this->parser_options = $parser_options;

		try {
			$this->xml = new \SimpleXMLElement($this->raw);
			if($this->getStatus() === 'OK'){
				$this->success = true;
			} else {
				$this->success = false;
			}


		} catch (\Exception $e) {
			echo $e;
		}
	}

	/**
	 * Returns the CommandResponse
	 *
	 * @return Array An array representing the CommandResponses, null if invalid response
	 */
	public function getData()
	{
		if($this->xml && $this->xml instanceof \SimpleXMLElement){
			return $this->xmlToArray($this->xml->CommandResponse)['CommandResponse'];
		}

		return null;
	}


	/**
	 * Returns the response status (OK = success, ERROR = error, null = invalid responses)
	 *
	 * @return string NULL
	 */
	public function getStatus()
	{
		if($this->xml && $this->xml instanceof \SimpleXMLElement){
			return (string)$this->xml->attributes()->Status;
		}

		return null;
	}

	/**
	 * Returns errors contained in the response
	 *
	 * @return string|array
	 */
	public function getErrors()
	{
		if($this->xml && $this->xml instanceof \SimpleXMLElement){
			return $this->xmlToArray($this->xml->Errors);
		}

		return null;
	}

	/**
	 * Returns warnings contained in the response
	 *
	 * @return array|NULL
	 */
	public function getWarnings()
	{
		if($this->xml && $this->xml instanceof \SimpleXMLElement){
			return $this->xmlToArray($this->xml->Warnings);
		}

		return false;
	}

	/**
	 * Returns the XML response
	 *
	 * @return string
	 */
	public function getXml()
	{
		return $this->xml;
	}

	/**
	 * Returns the raw XML response
	 *
	 * @return string
	 */
	public function getRaw()
	{
		return $this->raw;
	}

	/**
	 * Returns the array representing the request
	 *
	 * @return array
	 */
	public function getRequest()
	{
		return $this->request;
	}

	/**
	 * Parses the request array and returns the full url with query string
	 *
	 * @return string
	 */
	public function getRequestUrl()
	{
		return $this->request['url'] . '?' . http_build_query($this->request['params']);
	}

	/**
	 * Returns an array from a SimpleXmlElement
	 *
	 * @param \SimpleXMLElement $data
	 * @return array
	 * @see http://outlandish.com/blog/xml-to-json/
	 */
	function xmlToArray($xml) {
		$options = $this->parser_options;

		$namespaces = $xml->getDocNamespaces();
		$namespaces[''] = null; //add base (empty) namespace

		//get attributes from all namespaces
		$attributesArray = array();
		foreach ($namespaces as $prefix => $namespace) {
			foreach ($xml->attributes($namespace) as $attributeName => $attribute) {
				//replace characters in attribute name
				if ($options['key_search']) $attributeName =
					str_replace($options['key_search'], $options['key_replace'], $attributeName);
				$attributeKey = $options['attribute_prefix']
					. ($prefix ? $prefix . $options['namespace_separator'] : '')
					. $attributeName;
				$attributesArray[$attributeKey] = (string)$attribute;
			}
		}

		//get child nodes from all namespaces
		$tagsArray = array();
		foreach ($namespaces as $prefix => $namespace) {
			foreach ($xml->children($namespace) as $childXml) {
				//recurse into child nodes
				$childArray = $this->xmlToArray($childXml, $options);
				list($childTagName, $childProperties) = each($childArray);

				//replace characters in tag name
				if ($options['key_search']) $childTagName =
					str_replace($options['key_search'], $options['key_replace'], $childTagName);
				//add namespace prefix, if any
				if ($prefix) $childTagName = $prefix . $options['namespace_separator'] . $childTagName;

				if (!isset($tagsArray[$childTagName])) {
					//only entry with this key
					//test if tags of this type should always be arrays, no matter the element count
					$tagsArray[$childTagName] =
						in_array($childTagName, $options['always_array']) || !$options['auto_array']
							? array($childProperties) : $childProperties;
				} elseif (
					is_array($tagsArray[$childTagName]) && array_keys($tagsArray[$childTagName])
					=== range(0, count($tagsArray[$childTagName]) - 1)
				) {
					//key already exists and is integer indexed array
					$tagsArray[$childTagName][] = $childProperties;
				} else {
					//key exists so convert to integer indexed array with previous value in position 0
					$tagsArray[$childTagName] = array($tagsArray[$childTagName], $childProperties);
				}
			}
		}

		//get text content of node
		$text_contentArray = array();
		$plainText = trim((string)$xml);
		if ($plainText !== '') $text_contentArray[$options['text_content']] = $plainText;

		//stick it all together
		$propertiesArray = !$options['auto_text'] || $attributesArray || $tagsArray || ($plainText === '')
			? array_merge($attributesArray, $tagsArray, $text_contentArray) : $plainText;

		//return node as array
		return array(
			$xml->getName() => $propertiesArray
		);
	}

}