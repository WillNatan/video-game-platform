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
    private $key;

    /**
     * @ORM\ManyToOne(targetEntity=VideoGame::class, inversedBy="gameKeys")
     */
    private $game;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKey(): ?string
    {
        return $this->key;
    }

    public function setKey(string $key): self
    {
        $this->key = $key;

        return $this;
    }

    public function getGame(): ?VideoGame
    {
        return $this->game;
    }

    public function setGame(?VideoGame $game): self
    {
        $this->game = $game;

        return $this;
    }
}
