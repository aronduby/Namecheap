<?php
namespace Namecheap\Api\Domains;

use Namecheap\Base;
use Namecheap\Response;

/**
 * An instance of this class represents the namecheap Domain NS set of APIs
 *
 * @author Steve Oliveira <steve@vougalabs.com>
 */
class Ns extends Base
{
    /**
     * @var string
     */
    private $namespace = 'namecheap.domains.ns.';

    /**
     * Creates a new nameserver
     *
     * @param array $params            
     *
     * @return Response
     * @see http://developer.namecheap.com/docs/doku.php?id=api-reference:domains.ns:create
     */
    public function create(array $params)
    {
        return $this->client->send($this->namespace.__FUNCTION__, $params);
    }

    /**
     * Deletes a nameserver associated with the requested domain
     *
     * @param array $params            
     *
     * @return Response
     * @see http://developer.namecheap.com/docs/doku.php?id=api-reference:domains.ns:delete
     */
    public function delete(array $params)
    {
        return $this->client->send($this->namespace.__FUNCTION__, $params);
    }

    /**
     * Retrieves information about a registered nameserver
     *
     * @param array $params            
     *
     * @return Response
     * @see http://developer.namecheap.com/docs/doku.php?id=api-reference:domains.ns:getinfo
     */
    public function getInfo(array $params)
    {
        return $this->client->send($this->namespace.__FUNCTION__, $params);
    }

    /**
     * Updates the IP address of a registered nameserver
     *
     * @param array $params            
     *
     * @return Response
     * @see http://developer.namecheap.com/docs/doku.php?id=api-reference:domains.ns:update
     */
    public function update(array $params)
    {
        return $this->client->send($this->namespace.__FUNCTION__, $params);
    }
}