<?php declare(strict_types=1);

namespace Yard\OpenWOO\Models;

class AdresEntity extends AbstractEntity
{
	protected array $required = ['Straat__huisnummer', 'Postcode', 'Stad'];

	protected function data(): array
	{
		if (empty($this->data)) {
			return [];
		}

		return [
			'Adres' => ! empty($this->data[self::PREFIX . 'Straat__huisnummer']) ? (string) $this->data[self::PREFIX . 'Straat__huisnummer'] : '',
			'Postcode' => ! empty($this->data[self::PREFIX . 'Postcode']) ? (string) $this->data[self::PREFIX . 'Postcode'] : '',
			'Stad' => ! empty($this->data[self::PREFIX . 'Stad']) ? (string) $this->data[self::PREFIX . 'Stad'] : '',
		];
	}
}