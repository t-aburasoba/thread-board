@inject('message_service', 'App\Services\MessageService')
@inject('image_service', 'App\Services\ImageService')

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('layouts.flash-message')
            {{ $threads->links() }}
        </div>
    </div>
    <div class="row justify-content-center">
        @foreach ($threads as $thread)
            <div class="col-md-10 mb-5">
                <div class="card text-left">
                    <div class="card-header">
                        <h3><span class="badge badge-primary">{{ $thread->messages->count() }} <small>レス</small></span></h3>
                        <h3 class="m-0">{{ $thread->name }}</h3>
                    </div>
                    @foreach ($thread->messages as $message)
                    @if ($loop->index >= 5)
                        @continue
                    @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $loop->iteration }} 名前：{{ $message->user->name }}：{{ $message->created_at }}</h5>
                            <p class="card-text">{!! $message_service->convertUrl($message->body) !!}</p>
                            <div class="row">
                                @if (!$message->images->isEmpty())
                                    @foreach ($message->images as $image)
                                    <div class="col-md-3">
                                        <img src="{{ $image_service->createTemporaryUrl($image->s3_file_path) }}" class="img-thumbnail" alt="">
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endforeach
                    <div class="card-footer">
                        @include('components.message-create', compact('thread'))
                        <a href="{{ route('threads.show', $thread->id) }}">全部読む</a>
                        <a href="{{ route('threads.show', $thread->id) }}">最新50</a>
                        <a href="{{ route('threads.show', $thread->id) }}">1-100</a>
                        <a href="{{ route('threads.index') }}">リロード</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
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
