<?php
declare(strict_types=1);

namespace Ttree\Voting\Domain\Aggregate\Voting;

use Neos\EventSourcing\EventStore\AbstractEventSourcedRepository;
use Neos\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 *
 * @method Voting get(string $identifier)
 */
final class VotingRepository extends AbstractEventSourcedRepository {

}
