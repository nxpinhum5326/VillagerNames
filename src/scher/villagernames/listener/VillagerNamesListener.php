<?php

declare(strict_types=1);

namespace scher\villagernames\listener;

use pocketmine\entity\Villager;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\ItemTypeIds as Ids;
use pocketmine\item\SpawnEgg;
use pocketmine\item\VanillaItems;
use pocketmine\player\GameMode;
use pocketmine\utils\TextFormat;
use scher\villagernames\utils\Utils;

class VillagerNamesListener implements Listener{
	public function onInteract(PlayerInteractEvent $event): void{
		$player = $event->getPlayer();
		$action = $event->getAction();
		$item = $event->getItem();
		$itemCount = $item->getCount();

		if($action == PlayerInteractEvent::RIGHT_CLICK_BLOCK){
			if($item instanceof SpawnEgg and $item->getTypeId() === Ids::VILLAGER_SPAWN_EGG){
				$event->cancel();

				$villager = new Villager($player->getLocation());
				$villager->setNameTag(TextFormat::colorize("&e" . Utils::getNameToVillager()));
				$villager->spawnToAll();

				if($player->getGamemode() != GameMode::SURVIVAL) return;

				if($item->getCount() > 1){
					$player->getInventory()->setItemInHand($item
					->setCount($itemCount - 1));
				}else{
					$player->getInventory()->setItemInHand(VanillaItems::AIR());
				}
			}
		}
	}
}
