<?php

namespace Electro\TransferMe;

use pocketmine\event\Event;
use pocketmine\item\Arrow;
use pocketmine\item\ItemFactory;
use pocketmine\level\Position;
use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\PluginBase;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginLoader;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\event\Listener;
use pocketmine\network\mcpe\protocol\TransferPacket;
use pocketmine\event\player\PlayerJoinEvent;

use pocketmine\utils\TextFormat;

use pocketmine\item\Item;

use pocketmine\entity\Entity;
use pocketmine\entity\NPC;
use pocketmine\entity\Human;
use pocketmine\entity\Skin;
use pocketmine\entity\Zombie;
use pocketmine\event\entity\EntitySpawnEvent;


class Main extends PluginBase implements Listener{

    public function onEnable(){

    }

    public function onDisable(){

    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
        switch($command->getName()){
            case "transfer":
                $server = $this->getServer();
                if (isset($args[0])){
                    if (isset($args[1])){
                        if (!isset($args[2])){
                            if ($sender instanceof Player){
                                $sender->transfer($args[0], $args[1]);
                            }
                            else{
                                $sender->sendMessage("Please use this command in-game");
                            }
                        }
                        else if ($args[2] == "all"){
                            foreach ($this->getServer()->getOnlinePlayers() as $players){
                                $players->transfer($args[0], $args[1]);
                            }
                        }
                        else{
                            if ($this->getServer()->getPlayer($args[2])){
                                $player = $this->getServer()->getPlayer($args[2]);
                                $player->transfer($args[0], $args[1]);
                            }
                            else{
                                $sender->sendMessage("§c" . $args[2] . " §ais not online");
                            }
                        }
                    }
                    else{
                        $sender->sendMessage("§cUsage: §a/transfer {IP} {Port} <PlayerName | all>");
                    }
                }
                else{
                    $sender->sendMessage("§cUsage: §a/transfer {IP} {Port} <PlayerName | all>");
                }
        }

        return true;
    }
}