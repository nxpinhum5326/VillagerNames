<?php

declare(strict_types=1);

namespace scher\villagernames\utils;

use scher\villagernames\Loader;

class Utils{
	public static function getVillagerNames(): array{
		return self::getPlugin()->getConfig()->get("names") ?? []; // TODO default names(xD)
	}

	public static function getNameToVillager(): string{
		$names = self::getVillagerNames();

		return (string)$names[array_rand($names)];
	}

	public static function getPlugin(): Loader{
		return Loader::getInstance();
	}
}
