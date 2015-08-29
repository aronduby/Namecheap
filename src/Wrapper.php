<?php

namespace Namecheap;

use Namecheap\Api\Domains;
use Namecheap\Api\Ssl;
use Namecheap\Api\Users;
use Namecheap\Api\Whoisguard;

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
	public function __construct($api_user, $api_key, $ip, $sandbox = false, ParserOptions $parser_options = null)
	{
		if($parser_options === null)
			$parser_options = new ParserOptions();

		$this->client = new Client($api_user, $api_key, $ip, $sandbox, $parser_options);
	}

	/**
	 * Get our Domains NS wrapper class
	 *
	 * @return Domains
	 */
	public function domains()
	{
		return new Domains($this->client);
	}

	/**
	 * Get an instance of the Ssl class
	 *
	 * @return Ssl
	 */
	public function ssl()
	{
		return new Ssl($this->client);
	}

	/**
	 * Get our Users NS wrapper class
	 *
	 * @return Users
	 */
	public function users()
	{
		return new Users($this->client);
	}

	/**
	 * Get an instance of the Whoisguard class
	 *
	 * @return Whoisguard
	 */
	public function whoisguard()
	{
		return new Whoisguard($this->client);
	}
}