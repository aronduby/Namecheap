<?php
/**
 * Created by PhpStorm.
 * User: Duby
 * Date: 8/23/2015
 * Time: 11:16 PM
 */

namespace Namecheap;

use Namecheap\Api\Client;

class Wrapper
{
	/**
	 * The client we'll be passing around
	 *
	 * @var Client
	 */
	protected $client;

	/**
	 * Wrapper constructor.
	 */
	public function __construct($api_user, $api_key, $ip, $sandbox = false)
	{
		$this->client = new Client($api_user, $api_key, $ip, $sandbox);
	}

	/**
	 * Get our Domains NS wrapper class
	 *
	 * @return Wrappers\Domains
	 */
	public function domains()
	{
		return new Wrappers\Domains($this->client);
	}

	/**
	 * Get an instance of the Ssl class
	 *
	 * @return Ssl\Ssl
	 */
	public function ssl()
	{
		return new Ssl\Ssl($this->client);
	}

	/**
	 * Get our Users NS wrapper class
	 *
	 * @return Wrappers\Users
	 */
	public function users()
	{
		return new Wrappers\Users($this->client);
	}

	/**
	 * Get an instance of the Whoisguard class
	 *
	 * @return Whoisguard\Whoisguard
	 */
	public function whoisguard()
	{
		return new Whoisguard\Whoisguard($this->client);
	}
}