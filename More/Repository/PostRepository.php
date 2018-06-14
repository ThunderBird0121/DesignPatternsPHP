<?php

namespace DesignPatterns\More\Repository;

use DesignPatterns\More\Repository\Domain\Post;

/**
 * This class is situated between Entity layer (class Post) and access object layer (MemoryStorage).
 *
 * Repository encapsulates the set of objects persisted in a data store and the operations performed over them
 * providing a more object-oriented view of the persistence layer
 *
 * Repository also supports the objective of achieving a clean separation and one-way dependency
 * between the domain and data mapping layers
 */
class PostRepository
{
    /**
     * @var Storage
     */
    private $persistence;

    public function __construct(Storage $persistence)
    {
        $this->persistence = $persistence;
    }

    public function findById(int $id): Post
    {
        $arrayData = $this->persistence->retrieve($id);

        if (is_null($arrayData)) {
            throw new \InvalidArgumentException(sprintf('Post with ID %d does not exist', $id));
        }

        return Post::fromState($arrayData);
    }

    public function save(Post $post)
    {
        $id = $this->persistence->persist([
            'text' => $post->getText(),
            'title' => $post->getTitle(),
        ]);

        $post->setId($id);
    }
}
