<?php

namespace App\Repositories;

use App\Thread;
use Carbon\Carbon;

class ThreadRepository
{
    /**
     * @var Thread
     */
    protected $thread;

    /**
     * ThreadRepository constructor.
     *
     * @param Thread $thread
     */
    public function __construct(Thread $thread)
    {
        $this->thread = $thread;
    }

    /**
     * Create new Thread.
     *
     * @return Thread $thread
     */
    public function create(array $data)
    {
        return $this->thread->create($data);
    }

    /**
     * Get paginated threads.
     *
     * @param int $per_page
     * @return Thread $threads
     */
    public function getPaginatedThreads(int $per_page)
    {
        return $this->thread->paginate($per_page);
    }

    /**
     * Find a thread by id
     *
     * @param int $id
     * @return Thread $thread
     */
    public function findById(int $id)
    {
        return $this->thread->find($id);
    }
    
    /**
     * Find a thread by id
     *
     * @param int $id
     * @return Thread $thread
     */
    public function updateTime(int $id)
    {
        $thread = $this->findById($id);
        $thread->latest_comment_time = Carbon::now();
        return $thread->save();
    }
}
