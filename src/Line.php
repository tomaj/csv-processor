<?php

namespace App\Import\Csv;

class Line
{
	private $items;

	public function __construct($items)
	{
		$this->items = $items;
	}

	public function get($key)
	{
		if (!$this->exists($key)) {
			throw new FieldNotExistsException("Field '$key' doesn't exists");
		}
		return $this->items[$key];
	}

	public function set($key, $value)
	{
		$this->items[$key] = $value;
	}

	public function remove($key)
	{
		if (!$this->exists($key)) {
			throw new FieldNotExistsException("Field '$key' doesn't exists");
		}
		$this->items[$key] = null;
		unset($this->items[$key]);
	}

	public function move($oldKey, $newKey)
	{
		if (!isset($this->items[$oldKey])) {
			throw new FieldNotExistsException("Field '$oldKey' doesn't exists");
		}
		$this->items[$newKey] = $this->items[$oldKey];
		$this->remove($oldKey);
	}

	public function exists($key)
	{
		return array_key_exists($key, $this->items);
	}

	public function count()
	{
		return count($this->items);
	}

	public function getArray()
	{
		return $this->items;
	}
}