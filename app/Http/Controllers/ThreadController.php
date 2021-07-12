<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\ThreadService;
use App\Http\Requests\ThreadRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ThreadRepository;
use App\Services\SlackNotificationService;

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
     * The ThreadService implementation.
     *
     * @var SlackNotificationService
     */
    protected $slack_notification_service;

    /**
     * Create a new controller instance.
     *
     * @param  ThreadService  $thread_service
     * @return void
     */
    public function __construct(
        ThreadService $thread_service,
        ThreadRepository $thread_repository,
        SlackNotificationService $slack_notification_service
    ) {
        $this->middleware('auth')->except('index');
        $this->thread_service = $thread_service;
        $this->thread_repository = $thread_repository;
        $this->slack_notification_service = $slack_notification_service;
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
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ThreadRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ThreadRequest $request)
    {
        try {
            $data = $request->only(
                ['name', 'content']
            );
            $this->thread_service->createNewThread($data, Auth::id());
            $this->slack_notification_service->send($request->name);
        } catch (Exception $error) {
            return redirect()->route('threads.index')->with('error', 'スレッドの新規作成に失敗しました。');
        }

        // redirect to index method
        return redirect()->route('threads.index')->with('success', 'スレッドの新規作成が完了しました。');
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
        //
    }
}
