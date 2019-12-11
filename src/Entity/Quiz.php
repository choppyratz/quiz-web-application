<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuizRepository")
 */
class Quiz
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $name;


    /**
     * @ORM\Column(type="datetime")
     */
    private $registrationTime;

    /**
     * @ORM\Column(type="bool")
     */
    private $isActive;

    /**
     * @ORM\Column(type="json")
     */
    private $quizInfo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setRegistrationTime(string $RegistrationTime): self
    {
        $this->RegistrationTime = $RegistrationTime;

        return $this;
    }

    public function getRegistrationTime(): ?string
    {
        return $this->RegistrationTime;
    }





}
