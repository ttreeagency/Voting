<?php
declare(strict_types=1);

namespace Ttree\Voting\Domain\Aggregate\Voting\Model;

use Neos\Flow\Annotations as Flow;

final class VotingIdentifier {

    protected $identifier;

    public function __construct(string $identifier, string $tag)
    {
        $this->identifier = trim($identifier) . '@' . trim($tag);
    }

    public static function toString(string $identifier, string $tag): string
    {
        return (string)new static($identifier, $tag);
    }

    public function __toString()
    {
        return $this->identifier;
    }
}
