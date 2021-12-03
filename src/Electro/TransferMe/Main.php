<?php

namespace Electro\TransferMe;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\player\Player;

class Main extends PluginBase implements Listener{
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
        switch($command->getName()){
            case "transfer":
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
                            if ($this->getServer()->getPlayerExact($args[2])){
                                $player = $this->getServer()->getPlayerExact($args[2]);
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
