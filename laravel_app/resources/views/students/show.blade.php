<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>生徒詳細</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@3.0.2/destyle.css">
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
</head>
<body>
    <h1>生徒詳細</h1>

    <section>
        <div class="div_left">
            @if($student->photo)
                <img src="{{ asset('storage/' . $student->photo) }}" alt="生徒の写真">
            @endif
            <p><strong>{{ $student->name }}</strong></p>
            <p>学籍番号: {{ $student->student_number }}</p>
            <p>学年: {{ $student->grade }} / クラス: {{ $student->class }}</p>
            <p>学科: {{ $student->department }}</p>
        </div>
        <div class="div_right">
            <label>氏名:</label>
            <p>{{ $student->name }}</p>

            <label>フリガナ:</label>
            <p>{{ $student->kana }}</p>

            <label>生年月日:</label>
            <p>{{ $student->birthday }}</p>

            <label>学籍番号:</label>
            <p>{{ $student->student_number }}</p>

            <label>学年:</label>
            <p>{{ $student->grade }}</p>

            <label>クラス:</label>
            <p>{{ $student->class }}</p>

            <label>学科:</label>
            <p>{{ $student->department }}</p>

            <label>メール:</label>
            <p>{{ $student->email }}</p>

            <label>電話:</label>
            <p>{{ $student->phone }}</p>

            <label>住所:</label>
            <p>{{ $student->address }}</p>
        </div>
    </section>
    
    <div style="text-align: center;">
        <a href="{{ route('students.index') }}" class="back_link">一覧に戻る</a>
    </div>
</body>
</html>
