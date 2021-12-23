<?php

namespace BabyySafira\AntiToxic;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {
	
	public function onEnable(){
		$this->getLogger()->info("Plugin Enable");
		$this->getServer()->getPluginManager()->registerEvents($this, $this); 
		$this->saveResource("config.yml");
		$this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML); 
	}
	
	public function onChat(PlayerChatEvent $event) {
		$player = $event->getPlayer();
		$data = $this->config->get("banned-chat");
		$banned = $data[array_rand($data)];
		
		if($event->getMessage() == $banned){
			$event->setCancelled(true);
		}
	}
}