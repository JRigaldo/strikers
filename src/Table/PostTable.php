<?php

namespace App\Table;

use \App\Model\Post;
use \App\Model\Category;
use App\PaginatedQuery;
use \PDO;

final class PostTable extends Table{

    protected $table = 'post';
    protected $class = Post::class;

    public function createPost(Post $post): void
    {
        $id = $this->create([
            'name' => $post->getName(),
            'slug' => $post->getSlug(),
            'content' => $post->getContent(),
            'created_at' => $post->getCreatedAt()->format('Y-m-d H:I:s'),
            'image' => $post->getImage(),
            'location' => $post->getLocation(),
            'website' => $post->getWebsite(),
            'participation' => $post->getParticipation(),
            'sharelink' => $post->getSharelink()
        ]);

        $post->setID($id);
    }

    public function updatePost(Post $post): void
    {
        $this->update([
            'id' => $post->getID(),
            'name' => $post->getName(),
            'slug' => $post->getSlug(),
            'content' => $post->getContent(),
            'created_at' => $post->getCreatedAt()->format('Y-m-d H:I:s'),
            'image' => $post->getImage(),
            'location' => $post->getLocation(),
            'website' => $post->getWebsite(),
            'participation' => $post->getParticipation(),
            'sharelink' => $post->getSharelink()
        ], $post->getID());
    }

    public function attachedCategories(int $id, array $categories)
    {
        $this->pdo->exec('DELETE FROM post_category WHERE post_id = ' . $id);
        $query = $this->pdo->prepare('INSERT INTO post_category SET post_id = ?, category_id = ?');
        foreach ($categories as $category){
            $query->execute([$id, $category]);
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