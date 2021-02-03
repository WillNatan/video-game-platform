<?php

namespace App\Entity;

use App\Repository\GameKeyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameKeyRepository::class)
 */
class GameKey
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gameKey;

    /**
     * @ORM\ManyToOne(targetEntity=VideoGame::class, inversedBy="gameKeys")
     */
    private $videoGame;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGameKey(): ?string
    {
        return $this->gameKey;
    }

    public function setGameKey(string $gameKey): self
    {
        $this->gameKey = $gameKey;

        return $this;
    }

    public function getVideoGame(): ?VideoGame
    {
        return $this->videoGame;
    }

    public function setVideoGame(?VideoGame $videoGame): self
    {
        $this->videoGame = $videoGame;

        return $this;
    }
}
