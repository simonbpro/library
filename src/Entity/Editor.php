<?php

namespace App\Entity;

use App\Repository\EditorRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: EditorRepository::class)]
class Editor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank()]
    #[ORM\Column(length: 255)]
    private ?string $editor_name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEditorName(): ?string
    {
        return $this->editor_name;
    }

    public function setEditorName(string $editor_name): static
    {
        $this->editor_name = $editor_name;

        return $this;
    }
}
