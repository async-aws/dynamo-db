<?php

namespace AsyncAws\DynamoDb\ValueObject;

/**
 * Represents the properties of a replica global secondary index.
 */
final class ReplicaGlobalSecondaryIndexDescription
{
    /**
     * The name of the global secondary index.
     *
     * @var string|null
     */
    private $indexName;

    /**
     * If not described, uses the source table GSI's read capacity settings.
     *
     * @var ProvisionedThroughputOverride|null
     */
    private $provisionedThroughputOverride;

    /**
     * @param array{
     *   IndexName?: null|string,
     *   ProvisionedThroughputOverride?: null|ProvisionedThroughputOverride|array,
     * } $input
     */
    public function __construct(array $input)
    {
        $this->indexName = $input['IndexName'] ?? null;
        $this->provisionedThroughputOverride = isset($input['ProvisionedThroughputOverride']) ? ProvisionedThroughputOverride::create($input['ProvisionedThroughputOverride']) : null;
    }

    /**
     * @param array{
     *   IndexName?: null|string,
     *   ProvisionedThroughputOverride?: null|ProvisionedThroughputOverride|array,
     * }|ReplicaGlobalSecondaryIndexDescription $input
     */
    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    public function getIndexName(): ?string
    {
        return $this->indexName;
    }

    public function getProvisionedThroughputOverride(): ?ProvisionedThroughputOverride
    {
        return $this->provisionedThroughputOverride;
    }
}
