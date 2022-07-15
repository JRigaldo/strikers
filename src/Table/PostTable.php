<?php

namespace App\Table;

use \App\Model\Post;
use \App\Model\Category;
use App\PaginatedQuery;
use \PDO;

final class PostTable extends Table{

    protected $table = 'post';
    protected $class = Post::class;

    public function create(Post $post): void
    {
        $query = $this->pdo->prepare("INSERT INTO {$this->table} SET name = :name, slug = :slug, content = :content, created_at = :created");
        $ok = $query->execute([
            'name' => $post->getName(),
            'slug' => $post->getSlug(),
            'content' => $post->getContent(),
            'created' => $post->getCreatedAt()->format('Y-m-d H:I:s')
        ]);
        if($ok === false){
            throw new \Exception("Impossible de créer l'enregistrement dans la table {$this->table}");
        }
        $post->setID($this->pdo->lastInsertId());
    }

    public function update(Post $post): void
    {
        $query = $this->pdo->prepare("UPDATE {$this->table} SET name = :name, slug = :slug, content = :content, created_at = :created WHERE id = :id");
        $ok = $query->execute([
            'id' => $post->getID(),
            'name' => $post->getName(),
            'slug' => $post->getSlug(),
            'content' => $post->getContent(),
            'created' => $post->getCreatedAt()->format('Y-m-d H:I:s')
        ]);
        if($ok === false){
            throw new \Exception("Impossible de modifier l'enregistrement {$post->getID()} dans la table {$this->table}");
        }
    }

    public function delete(int $id): void
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $ok = $query->execute([$id]);
        if($ok === false){
            throw new \Exception("Impossible de supprimer l'enregistrement $id dans la table {$this->table}");
        }
    }

    public function findPaginated()
    {
        $paginatedQuery = new PaginatedQuery(
            "SELECT * FROM {$this->table} ORDER BY created_at",
            "SELECT COUNT(id) from post",
            $this->pdo
        );

        $posts = $paginatedQuery->getItems(Post::class);
        (new CategoryTable($this->pdo))->hydratePost($posts);
        return [$posts, $paginatedQuery];

    }

    public function findPaginatedForCategory(int $categoryID)
    {
        $paginatedQuery = new PaginatedQuery(
            "SELECT p.* FROM {$this->table} p JOIN post_category pc ON pc.post_id = p.id WHERE pc.category_id = {$categoryID} ORDER BY created_at",
            "SELECT COUNT(category_id) FROM post_category WHERE category_id = {$categoryID}"
        );

        $posts = $paginatedQuery->getItems(Post::class);
        (new CategoryTable($this->pdo))->hydratePost($posts);
        return [$posts, $paginatedQuery];
    }

}