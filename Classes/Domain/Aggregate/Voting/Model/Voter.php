<?php
declare(strict_types=1);

namespace Ttree\Voting\Domain\Aggregate\Voting\Model;

use Neos\Flow\Annotations as Flow;

final class Voter {

    const CLIENT_IP_ADDRESS = 'Ttree.Voting:ClientIpAddress';

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $metadata = [];

    /**
     * @param string $name
     * @param array $metadata
     */
    public function __construct(string $name, array $metadata)
    {
        $this->name = $name;
        $this->metadata = $metadata;
    }

    public static function createWithClientIpAddress($name, $clientIpAddress)
    {
        return new static($name, [
            Voter::CLIENT_IP_ADDRESS => $clientIpAddress
        ]);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getMetadata(): array
    {
        return $this->metadata;
    }
}
