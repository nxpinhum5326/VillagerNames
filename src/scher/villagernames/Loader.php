<?php

declare(strict_types=1);

namespace scher\villagernames;

use pocketmine\plugin\PluginBase;
use scher\villagernames\listener\VillagerNamesListener;

class Loader extends PluginBase{
	private static Loader $instance;

	protected function onLoad(): void{
		self::$instance = $this;
	}

	protected function onEnable(): void{
		$this->saveDefaultConfig();

		self::$instance->getServer()->getPluginManager()->registerEvents(new VillagerNamesListener(), $this);
	}

	public static function getInstance(): Loader{
		return self::$instance;
	}
}
