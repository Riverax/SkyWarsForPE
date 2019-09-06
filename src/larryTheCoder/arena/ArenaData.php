<?php
/**
 * Adapted from the Wizardry License
 *
 * Copyright (c) 2015-2019 larryTheCoder and contributors
 *
 * Permission is hereby granted to any persons and/or organizations
 * using this software to copy, modify, merge, publish, and distribute it.
 * Said persons and/or organizations are not allowed to use the software or
 * any derivatives of the work for commercial use or any other means to generate
 * income, nor are they allowed to claim this software as their own.
 *
 * The persons and/or organizations are also disallowed from sub-licensing
 * and/or trademarking this software without explicit permission from larryTheCoder.
 *
 * Any persons and/or organizations using this software must disclose their
 * source code and have it publicly available, include this license,
 * provide sufficient credit to the original authors of the project (IE: larryTheCoder),
 * as well as provide a link to the original project.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
 * INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,FITNESS FOR A PARTICULAR
 * PURPOSE AND NON INFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE
 * USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace larryTheCoder\arena;


use larryTheCoder\utils\Utils;

/**
 * Stores everything about the arena config
 * file into a set of variables.
 *
 * @package larryTheCoder\arenaRewrite
 */
trait ArenaData {

	public $configVersion = "2-API-1.0";
	public $gameAPICodename = "";
	public $inSetup = false;

	// The root of the config.
	public $arenaEnable = false;
	public $arenaName = "";
	public $arenaMode = SetData::MODE_SOLO;

	// Team settings
	public $playerPerTeam = 0;
	public $worldTeamMembers = 0;
	public $monarchySystem = false;
	public $interactiveSpawns = false;

	// Signs section.
	public $enableJoinSign = false;
	public $joinSignX = 0;
	public $joinSignY = 0;
	public $joinSignZ = 0;
	public $statusLine1 = "";
	public $statusLine2 = "";
	public $statusLine3 = "";
	public $statusLine4 = "";
	public $joinSignWorld = "";
	public $statusLineUpdate = 2;

	// Chest section.
	public $refillChest = true;
	public $refillRate = 240;

	// Arena section.
	public $arenaTime = 0;
	public $arenaWorld = "";
	public $arenaSpecPos = null;
	public $spawnPedestals = [];
	public $maximumPlayers = 0;
	public $minimumPlayers = 0;
	public $arenaGraceTime = 0;
	public $enableSpectator = false;
	public $arenaBroadcastTM = [];
	public $arenaMoneyReward = 0;
	public $arenaStartingTime = 0;

	/**
	 * Parses the data for the arena
	 */
	public function parseData(){
		$data = $this->getArenaData();

		try{
			if($data['version'] !== $this->configVersion){
				throw new \InvalidArgumentException("Unsupported config version for {$this->gameAPICodename}");
			}

			$this->arenaEnable = boolval($data["enabled"]);
		}catch(\Exception $ignored){
			Utils::send("§6" . ucwords($this->arenaName) . " §a§l-§r§c Failed to verify config files.");
			$this->arenaEnable = false;

			return;
		}

		if($this->arenaEnable){
			Utils::send("§6" . ucwords($this->arenaName) . " §a§l-§r§a Arena loaded and enabled");
		}else{
			Utils::send("§6" . ucwords($this->arenaName) . " §a§l-§r§c Arena disabled");
		}
	}

	/**
	 * Returns the data of the arena.
	 *
	 * @return array
	 */
	public abstract function getArenaData();
}