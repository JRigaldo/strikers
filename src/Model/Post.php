<?php

namespace App\Model;
use \App\Helpers\Text;
use \DateTime;

class Post {

    private $id;
    private $name;
    private $content;
    private $slug;
    private $created_at;
    private $image;
    private $oldImage;
    private $pendingUpload = false;
    private $location;
    private $website;
    private $participation;
    private $sharelink;

    private $categories = [];

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getFormatedContent(): ?string
    {
        return nl2br(e($this->content));
    }

    public function getExcerpt(): ?string
    {
        if($this->content === null){
            return null;
        }
        return nl2br(htmlentities(Text::excerpt($this->content, 60)));
    }

    public function getCreatedAt(): DateTime
    {
        return new \DateTime($this->created_at);
    }

    public function setCreatedAt(string $date): self
    {
        $this->created_at = $date;
        return $this;
    }

    public function getID(): ?int
    {
        return $this->id;
    }

    public function setID(int $id): self
    {
        $this->id = $id;
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

    /* @return Category[] */
    public function getCategories(): array
    {
        return $this->categories;
    }

    public function addCategory(Category $category): void
    {
        $this->categories[] = $category;
        $category->setPost($this);
    }

    public function setCategories(array $categories): self
    {
        $this->categories = $categories;
        return $this;
    }

    public function getCategoriesIds(): array
    {
        $ids = [];
        foreach ($this->categories as $category) {
            $ids[] = $category->getID();
        }
        return $ids;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getImageURL(string $format): ?string
    {
        if(empty($this->image)){
            return null;
        }
        return '/uploads/posts/' . $this->image . '_' . $format . '.jpg';
    }

    public function setImage($image): self
    {
        if(is_array($image) && !empty($image['tmp_name'])){
            if(!empty($image)){
                $this->oldImage = $this->image;
            }
            $this->pendingUpload = true;
            $this->image = $image['tmp_name'];
        }
        if(is_string($image) && !empty($image)){
            $this->image = $image;
        }
        return $this;
    }

    public function getOldImage(): ?string
    {
        return $this->oldImage;
    }

    public function shouldUpload(): bool
    {
        return $this->pendingUpload;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation($location): self
    {
        $this->location = $location;
        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite($website): self
    {
        $this->website = $website;
        return $this;
    }

    public function getParticipation(): ?string
    {
        return $this->participation;
    }

    public function setParticipation($participation): self
    {
        $this->participation = $participation;
        return $this;
    }

    public function getSharelink(): ?string
    {
        return $this->sharelink;
    }

    public function setSharelink($sharelink): self
    {
        $this->sharelink = $sharelink;
        return $this;
    }

}