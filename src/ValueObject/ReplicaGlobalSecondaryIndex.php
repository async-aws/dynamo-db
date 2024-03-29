<?php

namespace AsyncAws\DynamoDb\ValueObject;

use AsyncAws\Core\Exception\InvalidArgument;

/**
 * Represents the properties of a replica global secondary index.
 */
final class ReplicaGlobalSecondaryIndex
{
    /**
     * The name of the global secondary index.
     *
     * @var string
     */
    private $indexName;

    /**
     * Replica table GSI-specific provisioned throughput. If not specified, uses the source table GSI's read capacity
     * settings.
     *
     * @var ProvisionedThroughputOverride|null
     */
    private $provisionedThroughputOverride;

    /**
     * @param array{
     *   IndexName: string,
     *   ProvisionedThroughputOverride?: null|ProvisionedThroughputOverride|array,
     * } $input
     */
    public function __construct(array $input)
    {
        $this->indexName = $input['IndexName'] ?? $this->throwException(new InvalidArgument('Missing required field "IndexName".'));
        $this->provisionedThroughputOverride = isset($input['ProvisionedThroughputOverride']) ? ProvisionedThroughputOverride::create($input['ProvisionedThroughputOverride']) : null;
    }

    /**
     * @param array{
     *   IndexName: string,
     *   ProvisionedThroughputOverride?: null|ProvisionedThroughputOverride|array,
     * }|ReplicaGlobalSecondaryIndex $input
     */
    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    public function getIndexName(): string
    {
        return $this->indexName;
    }

    public function getProvisionedThroughputOverride(): ?ProvisionedThroughputOverride
    {
        return $this->provisionedThroughputOverride;
    }

    /**
     * @internal
     */
    public function requestBody(): array
    {
        $payload = [];
        $v = $this->indexName;
        $payload['IndexName'] = $v;
        if (null !== $v = $this->provisionedThroughputOverride) {
            $payload['ProvisionedThroughputOverride'] = $v->requestBody();
        }

        return $payload;
    }

    /**
     * @return never
     */
    private function throwException(\Throwable $exception)
    {
        throw $exception;
    }
}
