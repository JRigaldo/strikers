<?php

namespace App\Model;
use \App\Helpers\Text;
use \DateTime;

class Post {

    private $id;
    private $name;
    private $content;
    private $created_at;

    private $categories = [];

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getExcerpt(): ?string
    {
        if($this->content === null){
            return null;
        }
        return nl2br(htmlentities(Text::excerpt($this->content, 60)));
    }

    public function getDateTime(): \DateTime
    {
        return new \DateTime($this->created_at);
    }

    public function getID(): ?int
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

}