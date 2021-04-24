@extends('layouts.app')

@section('content')
<div class="container">
    @include('layouts.flash-message')
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{ $threads->links() }}
        </div>
    </div>
    <div class="row justify-content-center">
        @foreach ($threads as $thread)
            <div class="col-md-8 mb-5">
                <div class="card text-center">
                    <div class="card-header">
                        <h3 class="m-0">{{ $thread->name }}</h3>
                    </div>
                    @foreach ($thread->messages as $message)
                        <div class="card-body">
                            <h5 class="card-title">{{ $loop->iteration }} 名前：{{ $message->user->name }}：{{ $message->created_at }}</h5>
                            <p class="card-text">{{ $message->body }}</p>
                        </div>
                    @endforeach
                    <div class="card-footer">
                        <form method="POST" action="{{ route('messages.store', $thread->id) }}" class="mb-5">
                            @csrf
                            <div class="form-group">
                                <label for="thread-first-content">内容</label>
                                <textarea name="body" class="form-control" id="thread-first-content" rows="3"
                                    required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">書き込む</button>
                        </form>
                        <a href="#">全部読む</a>
                        <a href="#">最新50</a>
                        <a href="#">1-100</a>
                        <a href="#">リロード</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h5 class="card-header">新規スレッド作成</h5>
                <div class="card-body">
                    <form method="POST" action="{{ route('threads.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="thread-title">スレッドタイトル</label>
                            <input name="name" type="text" class="form-control" id="thread-title" placeholder="タイトル"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="thread-first-content">内容</label>
                            <textarea name="content" class="form-control" id="thread-first-content" rows="3"
                                required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">スレッド作成</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
