<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('search');
        $grade = $request->input('grade');
        $class = $request->input('class');

        $students = Student::when($keyword, function($query, $keyword){
            $query->where('name', 'like', "%{$keyword}%");
        })->when($grade, function($query, $grade){
            $query->where('grade', $grade);
        })->when($class, function($query, $class){
            $query->where('class', $class);
        })->get();

        return view('students.index', compact('students', 'keyword', 'grade', 'class'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_number' => 'required|unique:students',
            'name' => 'required',
            'grade' => 'required|integer',
            'photo' => 'nullable|image|max:10240',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $data['photo'] = $path;
        }

        Student::create($data);

        return redirect()->route('students.index')->with('success', '生徒を登録しました');
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'student_number' => 'required|unique:students,student_number,' . $student->id,
            'name' => 'required',
            'grade' => 'required|integer',
            'photo' => 'nullable|image|max:10240',
        ]);

        $data = $request->all();

        if ($request->has('remove_photo') && $request->remove_photo == 1) {
            if ($student->photo && Storage::disk('public')->exists($student->photo)) {
                Storage::disk('public')->delete($student->photo);
            }
            $data['photo'] = null;
        } 
        elseif ($request->hasFile('photo')) {
            if ($student->photo && Storage::disk('public')->exists($student->photo)) {
                Storage::disk('public')->delete($student->photo);
            }
            $path = $request->file('photo')->store('photos', 'public');
            $data['photo'] = $path;
        } 
        else {
            $data['photo'] = $student->photo;
        }

        $student->update($data);

        return redirect()->route('students.index')->with('success', '生徒情報を更新しました');
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    public function destroy(Student $student)
    {
        if ($student->photo && Storage::disk('public')->exists($student->photo)) {
            Storage::disk('public')->delete($student->photo);
        }

        $student->delete();
        return redirect()->route('students.index')->with('success', '生徒を削除しました');
    }
}
