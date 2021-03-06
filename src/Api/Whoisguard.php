<?php
namespace Namecheap\Api;

use Namecheap\Base;
use Namecheap\Response;

/**
 * An instance of this class represents the namecheap Whoisguard set of APIs
 *
 * @author Steve Oliveira <steve@vougalabs.com>
 */
class Whoisguard extends Base
{
    /**
     * @var string
     */
    private $namespace = 'namecheap.whoisguard.';


    /**
     * Allots WhoisGuard privacy protection
     *
     * @param array $params            
     *
     * @return Response
     * @see http://developer.namecheap.com/docs/doku.php?id=api-reference:whoisguard:allot
     */
    public function allot(array $params)
    {
        return $this->client->send($this->namespace.__FUNCTION__, $params);
    }

    /**
     * Changes WhoisGuard email address
     *
     * @param array $params            
     *
     * @return Response
     * @see http://developer.namecheap.com/docs/doku.php?id=api-reference:whoisguard:changeemailaddress
     */
    public function changeEmailAddress(array $params)
    {
        return $this->client->send($this->namespace.__FUNCTION__, $params);
    }

    /**
     * Disables WhoisGuard privacy protection for the WhoisguardID
     *
     * @param array $params            
     *
     * @return Response
     * @see http://developer.namecheap.com/docs/doku.php?id=api-reference:whoisguard:disable
     */
    public function disable(array $params)
    {
        return $this->client->send($this->namespace.__FUNCTION__, $params);
    }

    /**
     * Discards the WhoisGuard
     *
     * @param array $params            
     *
     * @return Response
     * @see http://developer.namecheap.com/docs/doku.php?id=api-reference:whoisguard:discard
     */
    public function discard(array $params)
    {
        return $this->client->send($this->namespace.__FUNCTION__, $params);
    }

    /**
     * Enables WhoisGuard privacy protection for the WhoisguardID
     *
     * @param array $params            
     *
     * @return Response
     * @see http://developer.namecheap.com/docs/doku.php?id=api-reference:whoisguard:enable
     */
    public function enable(array $params)
    {
        return $this->client->send($this->namespace.__FUNCTION__, $params);
    }

    /**
     * Unallots WhoisGuard privacy protection for the WhoisguardID
     *
     * @param array $params            
     *
     * @return Response
     * @see http://developer.namecheap.com/docs/doku.php?id=api-reference:whoisguard:unallot
     */
    public function unallot(array $params)
    {
        return $this->client->send($this->namespace.__FUNCTION__, $params);
    }
}