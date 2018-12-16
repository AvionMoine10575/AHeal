<?php
namespace AHeal;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as c;
use pocketmine\Player;
class main extends PluginBase{
     public function onEnable(){
          $this->getLogger()->info(c::GREEN. "You enabled the heal!");
     }
     public function onCommand(CommandSender $sender, Command $command, $labels, array $args) :bool{
          $cmd = strtolower($command);
          if($cmd == "heal"){
               if($sender->hasPermission("heal.command") && $sender instanceof Player) {
                    $sender->setHealth($sender->getMaxHealth());
                    $sender->sendMessage(c::GREEN."You have been healed!");
               }
               if(isset($args[0])){
                    if($sender->hasPermission("heal.other")){
                      $player = $this->getServer()->getPlayer($args[0]);
                      if($player !== null){
                          $player->setHealth($sender->getMaxHealth());
                          $sender->sendMessage(c::GREEN. "$args[0] has been healed");
                          $player->sendMessage(c::GREEN. "You have been healed by ". $sender->getName());
                     }else{
                          $sender->sendMessage(c::RED. "Oops, player is not online... You can't heal him/her :(");
                     }
                    }
               }
          }
          return true;
     }
     public function onDisable(){
          $this->getLogger()->info(c::RED. "You just disabled the heal!");
     }
}