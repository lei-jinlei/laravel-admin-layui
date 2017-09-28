<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Student;

class StudentsController extends Controller
{
    public function index(Student $student)
    {
        $students = $student->orderBy('created_at', 'desc')
                            ->paginate(10);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required|max:255',
            'age'   => 'required|integer|numeric|between:0,50',
            'sex' => [
                'required',
                Rule::in([0, 1, 2]),   
            ],
        ]);
        $student = Student::create([
            'name'  => $request->name,
            'age'   => $request->age,
            'sex'   => $request->sex
        ]);
        session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
        return redirect()->route('students.show', [$student]);
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Student $student, Request $request)
    {
        $this->validate($request, [
            'name'  => 'required|max:255',
            'age'   => 'required|integer|numeric|between:0,50',
            'sex' => [
                'required',
                Rule::in([0, 1, 2]),   
            ],
        ]);

        $student->update($request->toArray());

        session()->flash('success', '学生资料更新成功！');

        return redirect()->route('students.show', $student->id);
    }

    public function destroy(Student $student)
    {
        $student->delete();
        session()->flash('success', '成功刪除学生！');
        return back();
    }

        

}
