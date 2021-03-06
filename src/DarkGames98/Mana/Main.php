<?php

namespace DarkGames98\Mana;

use pocketmine\;
	plugin\PluginBase;
	event\Listener;
	event\block\BlockBreakEvent;
};
use twisted\multieconomy\MultiEconomy;
class Main extends PluginBase implements Listener
{
	public function onEnable(){
		$this->saveDefaultConfig();
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	
	public function onBlockEvent(BlockBreakEvent $event):void{
		$player = $event->getPlayer();
		$block = $event->getBlock();
		if($event->isCancelled()) return;
		if(isset($this->getConfig()->getAll()[$block->getID().":".$block->getDamage()])){
			$multieconomy = MultiEconomy::getInstance()->getCurrency("Mana")->addToBalance($player->getName(), $this->getConfig()->getAll()[$block->getID().":".$block->getDamage()]);
		}elseif(isset($this->getConfig()->getAll()[$block->getID()])){
			$multieconomy = MultiEconomy::getInstance()->getCurrency("Mana")->addToBalance($player->getName(), $this->getConfig()->getAll()[$block->getID()]);
		}
	}
}
