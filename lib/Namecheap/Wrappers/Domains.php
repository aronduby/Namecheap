<?php
/**
 * Created by PhpStorm.
 * User: Duby
 * Date: 8/23/2015
 * Time: 11:22 PM
 */

namespace Namecheap\Wrappers;

use Namecheap\Api\Domains\Dns;
use Namecheap\Api\Domains\Domains as ApiDomains;
use Namecheap\Api\Domains\Ns;
use Namecheap\Api\Domains\Transfer;

class Domains extends Base
{

	/**
	 * Return an instance of the Dns class
	 *
	 * @return Dns
	 */
	public function dns()
	{
		return new Dns($this->client);
	}

	/**
	 * Return an instance of the Domains class
	 *
	 * @return ApiDomains
	 */
	public function domains()
	{
		return new ApiDomains($this->client);
	}

	/**
	 * Return an instance of the Ns class
	 *
	 * @return Ns
	 */
	public function ns()
	{
		return new Ns($this->client);
	}

	/**
	 * Return an instance of the Transfer class
	 *
	 * @return Transfer
	 */
	public function transfer()
	{
		return new Transfer($this->client);
	}
}