<?php

namespace LuckyMiner;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\entity\Effect;
use pocketmine\event\Listener;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\utils\Config;
use pocketmine\item\Item;
use pocketmine\block\Dirt;
use pocketmine\block\Stone;
use pocketmine\utils\TextFormat as TF;

class Main extends PluginBase implements Listener{
	
	/** @var array $breaks */
	private $breaks;
	// Will you even be needing this?? :o
	public function onEnable(){
	    $this->getServer()->getPluginManager()->registerEvents($this, $this);
		    @mkdir($this->getDataFolder());
	       # Config isn't used.
	       $this->getLogger()->info("Plugin enabled");
	}

    public function onBreak(BlockBreakEvent $event) : void {
	   if($event->isCancelled()) return;
	   $name = $event->getPlayer()->getName();
	   $item = Item::getItem();
	   $player = $event->getPlayer();
		foreach($event->getDrops() as $drop) {
	      			if ($event->$drop[$name][$item] >= 128){
	         		   $event->getPlayer()->sendTitle(TF::YELLOW . "You broke 128 blocks");
                 		   $player->addEffect(new EffectInstance(Effect::getEffect(Effect::Haste), (1 * 30), (1), (false)));
	         		   self::$breaks[$name] = 0;
	      		     	}else{
	        		   self::$breaks[$name]++;
	      			   }
			  }
   	}	
	/**
	 * @param Player $player
	 * @param int $id
	 * @param int $duration
	 * @param int $amplifier
	 */
	public static function giveEffect(Player $player, $id, $duration, $amplifier){
		$player->addEffect($effect);
	}
}
