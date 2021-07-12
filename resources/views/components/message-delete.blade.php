@if (Auth::guard('admin')->check())
    <form action="{{ route('admin.messages.destroy', [$thread, $message->id]) }}" method="post" class="my-2">
        @csrf
        @method('DELETE')
        <input type="submit" class="btn btn-danger" value="コメ削除" onclick="return confirm('メッセージを削除します。本当に実行してよろしいでしょうか?')">
    </form>
@endif