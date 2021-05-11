@if (Auth::guard('admin')->check())
    <a href="{{ route('admin.threads.show', $thread->id) }}">全部読む</a>
    <a href="{{ route('admin.threads.show', $thread->id) }}">最新50</a>
    <a href="{{ route('admin.threads.show', $thread->id) }}">1-100</a>
    <a href="{{ route('admin.threads.index') }}">リロード</a>
@else
    <a href="{{ route('threads.show', $thread->id) }}">全部読む</a>
    <a href="{{ route('threads.show', $thread->id) }}">最新50</a>
    <a href="{{ route('threads.show', $thread->id) }}">1-100</a>
    <a href="{{ route('threads.index') }}">リロード</a>
@endif