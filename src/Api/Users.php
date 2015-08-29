<?php
namespace Namecheap\Api;

use Namecheap\Base;
use Namecheap\Response;

use Namecheap\Api\Users\Address;

/**
 * An instance of this class represents the namecheap users set of APIs
 *
 * @author Steve Oliveira <steve@vougalabs.com>
 */
class Users extends Base
{

    /**
     *
     * @var string
     */
    private $namespace = 'namecheap.users.';



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
     * Creates a new user account at NameCheap under this ApiUser.
     *
     * NOTE: Use the global parameter "UserName" to specify new user value.
     *
     * @param array $params            
     *
     * @return Response
     * @see http://developer.namecheap.com/docs/doku.php?id=api-reference:users:create
     */
    public function create(array $params)
    {
        return $this->client->send($this->namespace . __FUNCTION__, $params);
    }

    /**
     * Returns pricing information for a requested product type.
     *
     * @param array $params            
     *
     * @return Response
     * @see http://developer.namecheap.com/docs/doku.php?id=api-reference:users:getpricing
     */
    public function getPricing(array $params)
    {
        return $this->client->send($this->namespace . __FUNCTION__, $params);
    }

    /**
     * Gets information about fund in the user's account.
     *
     * This method returns the following information: Available Balance, Account Balance, Earned Amount, Withdrawable Amount and Funds Required for AutoRenew.
     * NOTE: If a domain setup with automatic renewal is expiring within the next 90 days, the "FundsRequiredForAutoRenew"
     * attribute shows the amount needed in your NameCheap account to complete auto renewal.
     *
     *
     * @return Response
     * @see http://developer.namecheap.com/docs/doku.php?id=api-reference:users:getbalances
     */
    public function getBalances()
    {
        return $this->client->send($this->namespace . __FUNCTION__);
    }

    /**
     * Changes password of the particular user's account.
     *
     * @param array $params            
     *
     * @return Response
     * @see http://developer.namecheap.com/docs/doku.php?id=api-reference:users:changepassword
     */
    public function changePassword(array $params)
    {
        return $this->client->send($this->namespace . __FUNCTION__, $params);
    }

    /**
     * Updates user account information for the particular user.
     *
     * @param array $params            
     *
     * @return Response
     * @see http://developer.namecheap.com/docs/doku.php?id=api-reference:users:update
     */
    public function update(array $params)
    {
        return $this->client->send($this->namespace . __FUNCTION__, $params);
    }
}