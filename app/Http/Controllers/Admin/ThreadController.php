<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Services\ThreadService;
use App\Http\Controllers\Controller;
use App\Repositories\ThreadRepository;

class ThreadController extends Controller
{
    /**
     * The ThreadService implementation.
     *
     * @var ThreadService
     */
    protected $thread_service;

    /**
     * The ThreadRepository implementation.
     *
     * @var ThreadRepository
     */
    protected $thread_repository;

    /**
     * Create a new controller instance.
     *
     * @param  ThreadService  $thread_service
     * @return void
     */
    public function __construct(
        ThreadService $thread_service,
        ThreadRepository $thread_repository
    ) {
        $this->thread_service = $thread_service;
        $this->thread_repository = $thread_repository;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $threads = $this->thread_service->getThreads(3);
        $threads->load('messages.user', 'messages.images');
        return view('threads.index', compact('threads'));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $thread = $this->thread_repository->findById($id);
        $thread->load('messages.user', 'messages.images');
        return view('threads.show', compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->thread_repository->deleteThread($id);
        } catch (Exception $error) {
            return redirect()->route('admin.threads.index')->with('error', 'スレッドの削除に失敗しました。');
        }
        return redirect()->route('admin.threads.index')->with('success', 'スレッドの削除に成功しました。');
    }
}
