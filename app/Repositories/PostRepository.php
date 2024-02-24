<?php

namespace App\Repositories;

use App\Models\Post;

/**
 * Class PostRepository
 * @package App\Repositories
 */
class PostRepository
{
    /**
     * Retrieve all posts from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        // Utilizing Eloquent ORM to fetch all posts
        return Post::all();
    }

    /**
     * Create a new post in the database.
     *
     * @param array $data The data to create the post with.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        // Creating a new post record using Eloquent ORM
        return Post::create($data);
    }

    /**
     * Retrieve a specific post by its ID.
     *
     * @param mixed $id The ID of the post to retrieve.
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection
     */
    public function getById($id)
    {
        // Fetching a post by its ID using Eloquent ORM
        // If the post is not found, an exception will be thrown
        return Post::findOrFail($id);
    }

    /**
     * Update a post.
     *
     * @param int $id The ID of the post to update.
     * @param array $data The data to update the post with.
     * @return \App\Models\Post|null The updated post or null if the post does not exist.
     */
    public function update($id, array $data)
    {
        $post = Post::find($id);

        if (!$post) {
            return null;
        }

        $post->update($data);

        return $post;
    }

    /**
     * Delete a post.
     *
     * @param int $id The ID of the post to delete.
     * @return bool True if the post was deleted successfully, false otherwise.
     */
    public function delete($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return false;
        }

        return $post->delete();
    }
}
