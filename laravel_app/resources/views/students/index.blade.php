<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@3.0.2/destyle.css">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>
    <main>
        <h1>生徒一覧</h1>
        <p class="search_detail">検索詳細</p>
        <section>
            <form method="GET" action="{{ route('students.index') }}">
                <input type="text" name="search" value="{{ $keyword ?? '' }}" placeholder="名前で検索">
                <input type="number" name="grade" value="{{ $grade ?? '' }}" placeholder="学年">
                <input type="text" name="class" value="{{ $class ?? '' }}" placeholder="クラス">
                <button type="submit">検索</button>
            </form>
        </section>
        <table>
            <thead>
                <tr>
                    <th>学籍番号</th>
                    <th>氏名</th>
                    <th>学年</th>
                    <th>クラス</th>
                    <th>写真</th>
                    <th>詳細</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                    <tr>
                        <td>{{ $student->student_number }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->grade }}</td>
                        <td>{{ $student->class }}</td>
                        <td>
                            @if($student->photo)
                                <img src="{{ asset('storage/' . $student->photo) }}" width="50" alt="写真">
                            @else
                                なし
                            @endif
                        </td>
                        <td><a href="{{ route('students.show', $student->id) }}">詳細</a></td>
                        <td>
                            <a href="{{ route('students.edit', $student->id) }}">編集</a>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('削除してもよろしいですか？')">削除</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">生徒が見つかりませんでした</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
            <a href="{{ route('students.create') }}" class="create_link">新規登録</a>
    </main>

</body>
</html>