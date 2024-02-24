<?php

namespace App\Services;

use App\Repositories\PostRepository;

/**
 * Class PostService
 * @package App\Services
 */
class PostService
{
    /**
     * @var PostRepository
     */
    protected $postRepository;

    /**
     * PostService constructor.
     *
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Get all posts.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllPosts()
    {
        return $this->postRepository->getAll();
    }

    /**
     * Create a new post.
     *
     * @param array $data
     * @return \App\Models\Post
     */
    public function createPost(array $data)
    {
        return $this->postRepository->create($data);
    }

    /**
     * Get a post by ID.
     *
     * @param int $id
     * @return \App\Models\Post|null
     */
    public function getPostById($id)
    {
        return $this->postRepository->getById($id);
    }

    /**
     * Update a post.
     *
     * @param int $id The ID of the post to update.
     * @param array $data The data to update the post with.
     * @return \App\Models\Post|null The updated post or null if the post does not exist.
     */
    public function updatePost($id, array $data)
    {
        return $this->postRepository->update($id, $data);
    }

    /**
     * Delete a post.
     *
     * @param int $id The ID of the post to delete.
     * @return bool True if the post was deleted successfully, false otherwise.
     */
    public function deletePost($id)
    {
        return $this->postRepository->delete($id);
    }
}
