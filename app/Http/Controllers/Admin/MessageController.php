<?php

namespace App\Http\Controllers\Admin;

use App\Thread;
use App\Http\Controllers\Controller;
use App\Repositories\MessageRepository;

class MessageController extends Controller
{
    /**
     * The MessageRepository implementation.
     *
     * @var MessageRepository
     */
    protected $message_repository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        MessageRepository $message_repository
    ) {
        $this->middleware('auth:admin');
        $this->message_repository = $message_repository;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Thread  $thread
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread, $id)
    {
        try {
            $this->message_repository->deleteMessage($id);
        } catch (Exception $error) {
            return redirect()->route('admin.threads.show', $thread->id)->with('error', 'メッセージの削除に失敗しました。');
        }
        return redirect()->route('admin.threads.show', $thread->id)->with('success', 'メッセージの削除に成功しました。');
    }
}
