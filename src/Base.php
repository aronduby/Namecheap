<?php

namespace Namecheap;

/**
* Namecheap base class.
*
* @package Namecheap
* @author Steve Oliveira <steve@vougalabs.com>
*/
abstract class Base
{
	protected $client;
	
	/**
	 * Sets the Namecheap client
	 * 
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
	}
}