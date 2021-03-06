<?php

namespace App\Entity;

use App\Repository\VideoGameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VideoGameRepository::class)
 */
class VideoGame
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
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="games")
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $trailerUrl;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity=GameKey::class, mappedBy="videoGame")
     */
    private $gameKeys;

    public function __construct()
    {
        $this->gameKeys = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getTrailerUrl(): ?string
    {
        return $this->trailerUrl;
    }

    public function setTrailerUrl(string $trailerUrl): self
    {
        $this->trailerUrl = $trailerUrl;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|GameKey[]
     */
    public function getGameKeys(): Collection
    {
        return $this->gameKeys;
    }

    public function addGameKey(GameKey $gameKey): self
    {
        if (!$this->gameKeys->contains($gameKey)) {
            $this->gameKeys[] = $gameKey;
            $gameKey->setVideoGame($this);
        }

        return $this;
    }

    public function removeGameKey(GameKey $gameKey): self
    {
        if ($this->gameKeys->removeElement($gameKey)) {
            // set the owning side to null (unless already changed)
            if ($gameKey->getVideoGame() === $this) {
                $gameKey->setVideoGame(null);
            }
        }

        return $this;
    }
}
