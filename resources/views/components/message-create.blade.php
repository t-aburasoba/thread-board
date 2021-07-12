@if (Auth::guard('admin')->check())
    <form action="{{ route('admin.threads.destroy', $thread->id) }}" method="post" class="mb-4">
        @csrf
        @method('DELETE')
        <input type="submit" class="btn btn-danger" value="スレ削除" onclick="return confirm('スレッドを削除します。本当に実行してよろしいでしょうか?')">
    </form>
@else
    <form method="POST" action="{{ route('messages.store', $thread->id) }}" enctype="multipart/form-data" class="mb-1">
        @csrf
        <div class="form-group">
            <label for="thread-first-content">内容</label>
            <textarea name="body" class="form-control" id="thread-first-content" rows="3"
                required></textarea>
        </div>
        <div class="form-group">
            <label for="message-images">画像</label>
            <input type="file" class="form-control-file" id="message-images" name="images[]" multiple>
        </div>
        <button type="submit" class="btn btn-primary">書き込む</button>
    </form>
@endif