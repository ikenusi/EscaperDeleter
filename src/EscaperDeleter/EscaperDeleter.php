<?php

namespace EscaperDeleter;


use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\Listener;

use pocketmine\plugin\PluginBase;

class EscaperDeleter extends PluginBase implements Listener{

	public function onLoad(){
	}

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onDisable(){
	}

	public function onQuit(PlayerQuitEvent $event){
		$p = $event->getPlayer();
		$s = $this->getServer();
		foreach($p->getViewers() as $ps){
			if($ps !== $p && !$ps->isSneaking() && $ps->distance($p) < 10){
				$p->attack(100000, new EntityDamageEvent($p, EntityDamageEvent::CAUSE_MAGIC, 100000));
				$p->setSpawn($p->getLevel()->getSpawn());
				break;
			}
		}

	}


}