<?php

declare(strict_types = 1);

namespace SmartEmailing\Types;

use SmartEmailing\Types\ExtractableTraits\ArrayExtractableTrait;
use SmartEmailing\Types\Helpers\ValidationHelpers;

final class ScalarLeavesArray implements ToArrayInterface
{

	use ArrayExtractableTrait;

	/**
	 * @var mixed[]
	 */
	private $data;

	/**
	 * @param mixed[] $data
	 */
	public function __construct(
		array $data
	) {
		if (!ValidationHelpers::isScalarLeavesArray($data)) {
			throw new InvalidTypeException('Array must have all it\'s leaves scalar or null');
		}

		$this->data = $data;
	}

	/**
	 * @param mixed[] $data
	 * @param string $key
	 * @return self
	 */
	public static function extractOrEmpty(
		array $data,
		string $key
	): self {
		$self = self::extractOrNull(
			$data,
			$key
		);

		if ($self) {
			return $self;
		}

		return new self([]);
	}

	/**
	 * @return mixed[]
	 */
	public function toArray(): array
	{
		return $this->data;
	}

}
