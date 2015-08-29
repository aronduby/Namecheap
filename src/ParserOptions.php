<?php

namespace Namecheap;


class ParserOptions implements \ArrayAccess
{
	/**
	 * Separator for namespaced tag
	 *
	 * @var string
	 */
	public $namespace_separator = ':';

	/**
	 * To distinguish between attributes and nodes with the same name
	 *
	 * @var string
	 */
	public $attribute_prefix = '@';

	/**
	 * Array of XML tag names which should always become arrays
	 *
	 * @var array
	 */
	public $always_array = [];

	/**
	 * Only create arrays for tags which appear more than once?
	 *
	 * True is easier to view, false is more consistent and easier to parse
	 *
	 * @var bool
	 */
	public $auto_array = false;

	/**
	 * Key used for text content of elements
	 *
	 * @var string
	 */
	public $text_content = '$';

	/**
	 * Skip text_content key if node has no attributes or has child nodes
	 *
	 * @var bool
	 */
	public $auto_text = true;

	/**
	 * Optional search and replace on tag and attribute names (passed to str_replace)
	 *
	 * @var bool
	 */
	public $key_search = false;

	/**
	 * Replace vales for $key_search values (passed to str_replace)
	 *
	 * @var bool
	 */
	public $key_replace = false;

	/**
	 * Whether a offset exists
	 *
	 * @link http://php.net/manual/en/arrayaccess.offsetexists.php
	 * @param mixed $offset <p>
	 * An offset to check for.
	 * </p>
	 * @return boolean true on success or false on failure.
	 * </p>
	 * <p>
	 * The return value will be casted to boolean if non-boolean was returned.
	 * @since 5.0.0
	 */
	public function offsetExists($offset)
	{
		return property_exists($this, $offset);
	}

	/**
	 * Offset to retrieve
	 *
	 * @link http://php.net/manual/en/arrayaccess.offsetget.php
	 * @param mixed $offset <p>
	 * The offset to retrieve.
	 * </p>
	 * @return mixed Can return all value types.
	 * @since 5.0.0
	 */
	public function offsetGet($offset)
	{
		return $this->$offset;
	}

	/**
	 * Offset to set
	 *
	 * @link http://php.net/manual/en/arrayaccess.offsetset.php
	 * @param mixed $offset <p>
	 * The offset to assign the value to.
	 * </p>
	 * @param mixed $value <p>
	 * The value to set.
	 * </p>
	 * @return void
	 * @since 5.0.0
	 */
	public function offsetSet($offset, $value)
	{
		$this->$offset = $value;
	}

	/**
	 * Offset to unset
	 *
	 * @link http://php.net/manual/en/arrayaccess.offsetunset.php
	 * @param mixed $offset <p>
	 * The offset to unset.
	 * </p>
	 * @return void
	 * @since 5.0.0
	 */
	public function offsetUnset($offset)
	{
		// intentionally left blank
	}

}