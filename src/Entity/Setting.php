<?php

namespace App\Entity;

use App\Repository\SettingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SettingRepository::class)]
class Setting
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $appName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $smtpUser = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $smtpPassword = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $smtpHost = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $smtpPort = null;

    #[ORM\Column]
    private ?int $pageSize;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAppName(): ?string
    {
        return $this->appName;
    }

    public function setAppName(string $appName): self
    {
        $this->appName = $appName;

        return $this;
    }

    public function getSmtpUser(): ?string
    {
        return $this->smtpUser;
    }

    public function setSmtpUser(?string $smtpUser): self
    {
        $this->smtpUser = $smtpUser;

        return $this;
    }

    public function getSmtpPassword(): ?string
    {
        return $this->smtpPassword;
    }

    public function setSmtpPassword(?string $smtpPassword): self
    {
        $this->smtpPassword = $smtpPassword;

        return $this;
    }

    public function getSmtpHost(): ?string
    {
        return $this->smtpHost;
    }

    public function setSmtpHost(?string $smtpHost): self
    {
        $this->smtpHost = $smtpHost;

        return $this;
    }

    public function getSmtpPort(): ?string
    {
        return $this->smtpPort;
    }

    public function setSmtpPort(?string $smtpPort): self
    {
        $this->smtpPort = $smtpPort;

        return $this;
    }

    public function isIsArticlePublish(): ?bool
    {
        return $this->isArticlePublish;
    }

    public function setIsArticlePublish(bool $isArticlePublish): self
    {
        $this->isArticlePublish = $isArticlePublish;

        return $this;
    }

    public function getPageSize(): ?int
    {
        return $this->pageSize;
    }

    public function setPageSize(int $pageSize): self
    {
        $this->pageSize = $pageSize;

        return $this;
    }
}
