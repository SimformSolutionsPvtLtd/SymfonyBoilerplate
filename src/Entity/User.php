<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(
    fields: ['email'],
    errorPath: 'email',
    message: 'Email should be unique'
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank(
        message: 'Email should not be blank'
    )]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    #[Assert\NotBlank(
        message: 'Password should not be blank'
    )]
    #[ORM\Column]
    private ?string $password = null;

    #[Assert\NotBlank(
        message: 'Name should not be blank'
    )]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true, name:'contact_number')]
    #[Assert\Regex(
        pattern: '/^[0-9]+$/',
        match: true,
        message: 'Only Number is allowed'
    )]
    private ?string $contactNumber = null;

    #[ORM\ManyToOne]
    private ?CountryCode $countryCode = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getContactNumber(): ?string
    {
        return $this->contactNumber;
    }

    public function setContactNumber(?string $contactNumber): self
    {
        $this->contactNumber = $contactNumber;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getCountryCode(): ?CountryCode
    {
        return $this->countryCode;
    }

    public function setCountryCode(?CountryCode $countryCode): self
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * It will check for country code and mobile number
     * #[Assert\Callback()
     */
    public function isValid(ExecutionContextInterface $context)
    {
        if( !is_object($this->getCountryCode()) && $this->contactNumber() ){
            $context->buildViolation('No country code selected')
                ->atPath('contactNumber')
                ->addViolation();
        }
    }
}
