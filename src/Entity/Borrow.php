<?php

namespace App\Entity;

use App\Repository\BorrowRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BorrowRepository::class)
 */
class Borrow
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Name::class, inversedBy="borrows")
     */
    public $Student_fullname;

    /**
     * @ORM\ManyToOne(targetEntity=Book::class, inversedBy="borrows")
     */
    public $Book_name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getStudentFullname(): ?Name
    {
        return $this->Student_fullname;
    }

    public function setStudentFullname(?Name $Student_fullname): self
    {
        $this->Student_fullname = $Student_fullname;

        return $this;
    }

    public function getBookName(): ?Book
    {
        return $this->Book_name;
    }

    public function setBookName(?Book $Book_name): self
    {
        $this->Book_name = $Book_name;

        return $this;
    }
}
