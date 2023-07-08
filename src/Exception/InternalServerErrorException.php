<?php

namespace AsyncAws\DynamoDb\Exception;

use AsyncAws\Core\Exception\Http\ClientException;

/**
 * An error occurred on the server side.
 */
final class InternalServerErrorException extends ClientException
{
}
