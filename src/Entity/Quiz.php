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
     * @ORM\Column(type="string", length=255, unique=true, nullable=true)
     */
    private $name;


    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $registrationTime;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $isActive;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $quizInfo;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $rating;

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

    public function setRegistrationTime($registrationTime): self
    {
        $this->registrationTime = $registrationTime;

        return $this;
    }

    public function getRegistrationTime(): ?string
    {
        return $this->registrationTime;
    }

    public function setQuizInfo($quizInfo): self
    {
        $this->quizInfo = $quizInfo;

        return $this;
    }

    public function getQuizInfo()
    {
        return $this->quizInfo;
    }

    public function setisActive(string $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getisActive(): ?int
    {
        return $this->isActive;
    }

    public function setRating($rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getRating()
    {
        return $this->rating;
    }





}
