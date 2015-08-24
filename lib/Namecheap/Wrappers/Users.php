<?php
/**
 * Created by PhpStorm.
 * User: Duby
 * Date: 8/23/2015
 * Time: 11:22 PM
 */

namespace Namecheap\Wrappers;


use Namecheap\Users\Address;
use Namecheap\Users\Users as ApiUsers;

class Users extends Base
{
	/**
	 * Get an instance of the Address class
	 *
	 * @return Address
	 */
	public function address()
	{
		return new Address($this->client);
	}

	/**
	 * Get an instance of the Users class
	 *
	 * @return ApiUsers
	 */
	public function users()
	{
		return new ApiUsers($this->client);
	}
}