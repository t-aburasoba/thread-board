<?php

namespace App\Services;

use Exception;
use App\Repositories\ThreadRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MessageService
{
    /**
     * @var ThreadRepository
     */
    protected $thread_repository;

    /**
     * ThreadService constructor.
     *
     * @param ThreadRepository $thread_repository
     */
    public function __construct(
        ThreadRepository $thread_repository
    ) {
        $this->thread_repository = $thread_repository;
    }
    
    /**
     * Create new message and first new message.
     *
     * @param array $data
     * @return Tread $thread
     */
    public function createNewMessage(array $data, string $thread_id)
    {
        DB::beginTransaction();
        try {
            $thread = $this->thread_repository->findById($thread_id);
            $message = $thread->messages()->create($data);
            $this->thread_repository->updateTime($thread_id);
        } catch (Exception $error) {
            DB::rollBack();
            Log::error($error->getMessage());
            throw new Exception($error->getMessage());
        }
        DB::commit();

        return $message;
    }
}
