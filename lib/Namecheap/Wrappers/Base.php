<?php
/**
 * Created by PhpStorm.
 * User: Duby
 * Date: 8/23/2015
 * Time: 11:23 PM
 */

namespace Namecheap\Wrappers;

use Namecheap\Api\Client;

class Base
{

	/**
	 * @var Client
	 */
	protected $client;

	/**
	 * Base constructor.
	 *
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
	}

}