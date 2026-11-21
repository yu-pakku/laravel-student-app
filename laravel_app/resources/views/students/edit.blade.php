<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@3.0.2/destyle.css">
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
</head>
<body>
    <h1>生徒情報 編集</h1>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label>学籍番号: </label>
            <input type="text" name="student_number" value="{{ old('student_number', $student->student_number) }}" required>
        </div>
        <div>
            <label>氏名: </label>
            <input type="text" name="name" value="{{ old('name', $student->name) }}" required>
        </div>
        <div>
            <label>フリガナ: </label>
            <input type="text" name="kana" value="{{ old('kana', $student->kana) }}">
        </div>
        <div>
            <label>生年月日: </label>
            <input type="date" name="birthday" value="{{ old('birthday', $student->birthday) }}">
        </div>
        <div>
            <label>学年: </label>
            <input type="number" name="grade" value="{{ old('grade', $student->grade) }}" required>
        </div>
        <div>
            <label>クラス: </label>
            <input type="text" name="class" value="{{ old('class', $student->class) }}" required>
        </div>
        <div>
            <label>学科: </label>
            <input type="text" name="department" value="{{ old('department', $student->department) }}">
        </div>
        <div>
            <label>メールアドレス: </label>
            <input type="email" name="email" value="{{ old('email', $student->email) }}">
        </div>
        <div>
            <label>電話番号: </label>
            <input type="text" name="phone" value="{{ old('phone', $student->phone) }}">
        </div>
        <div>
            <label>住所: </label>
            <input type="text" name="address" value="{{ old('address', $student->address) }}">
        </div>
        <div>
            <label>写真: </label>
            <input type="file" name="photo" accept="image/*">
            @if($student->photo)
                <img src="{{ asset('storage/' . $student->photo) }}" alt="現在の写真" width="100">
                <div>
                    <label>
                        <input type="checkbox" name="remove_photo" value="1"> この写真を削除
                    </label>
                </div>
            @endif
        </div>
        <div>
            <button type="submit">更新</button>
            <a href="{{ route('students.index') }}">戻る</a>
        </div>
    </form>
</body>
</html>