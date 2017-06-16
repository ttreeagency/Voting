<?php
declare(strict_types=1);

namespace Ttree\Voting\Projection\Participation;

use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 * @ORM\Table(name="ttree_voting_participation")
 */
class Participation {

    /**
     * @ORM\Id
     * @var string
     */
    public $voter;

    /**
     * @ORM\Id
     * @var string
     */
    public $voting;

    /**
     * @var int
     */
    public $value;

    /**
     * @var \DateTimeImmutable
     */
    public $at;

    public function __construct(string $voter, string $voting, int $value, \DateTimeImmutable $at)
    {
        $this->voter = $voter;
        $this->voting = $voting;
        $this->at = $at;
        $this->value = $value;
    }
}
