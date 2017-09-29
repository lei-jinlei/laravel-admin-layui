<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

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

    /**
     * 练习一些操作
     */
     // 添加操作
    public function query()
    {
        // $bool = DB::table('students')->insert([
        //     'name'  => 'imooc',
        //     'age'   => '19',
        // ]);
        // dd($bool);

        // $id = DB::table('students')->insertGetId([
        //     'name'  => 'test',
        //     'age'   => '20',
        // ]);
        // dd($id);

        // $bool = DB::table('students')->insert(
        //     ['name'=>'test-2','age'=>'20'],
        //     ['name'=>'test-3','age'=>'21']
        // );
        // dd($bool);
    }
    // 一些更新数据操作
    public function query2()
    {
        // $num = DB::table('students')
        //         ->where('id', 12)
        //         ->update(['age' => 30]);
        // dd($num);

        
        // // 自增
        // $num = DB::table('students')->increment('age');
        // $num = DB::table('students')->increment('age', 3);

        // // 自减
        // $num = DB::table('students')->decrement('age');
        // $num = DB::table('students')->decrement('age', 3);

        // $num = DB::table('students')
        //         ->where('id', 12)
        //         ->decrement(['age', 3, ['name' => 'test-55']]);
    }
    // 删除操作
    public function query3()
    {
        // $num = DB::table('students')
        //     ->where('id', 2)
        //     ->delete();
        // dd(num);
    }
    // 查询操作
    public function query4()
    {
        // 全部
        // $students = DB::table('students')->get();

        // 第一条
        $student = DB::table('students')
                    ->orderBy('id', 'desc')
                    ->first();

        // where
        $student = DB::table('students')
                    ->where('id', '>=', 1002)
                    ->get();
        
        $student = DB::table('students')
                    ->whereRaw('id >= ? and age > ?', [1001, 18])
                    ->get();
        
        // pluck
        $students = DB::table('students')
                    ->whereRaw('id >= ? and age > ?', [20, 18])
                    ->pluck('name');
        dd($students);
        
        // select
        $names = DB::table('students')
                    ->select('id', 'name', 'age')
                    ->get();
        
        // chunk
        DB::table('students')->chunk(10, function($students){
            var_dump($students);
            if ($students->id > 50) {
                return false;
            }
        });

    }
    // 聚合操作
    public function query5()
    {
        // $num = DB::table('students')->count();
        // dd($num);
        
        // $max = DB::table('students')->max('age');
        // dd($max);

        // $min = DB::table('students')->min('age');
        // dd($min);

        // $avg = DB::table('students')->avg('age');
        // dd($avg);
    }

    /**
     * 练习ORM操作
     */
    public function orm1()
    {
        // all()
        $students = Student::all();
        $students = Student::get();
        
        // find()
        $student = Student::find(22);

        // findOrFail
        $student = Student::findOrFail(1002);

        // where
        $student = Student::where('id', '>', '11')
                    ->orderBy('age', 'desc')
                    ->first();
        
        //chunk
        Student::chunk(2, function($students){
            var_dump($students);
        });
        
        // 聚合
        Student::count();
        $max = Student::where('id', '>', '12')->max('age');
        
        dd($student);
    }

    public function orm2()
    {

        // 使用模型新增数据
        $student = new Student();
        $student->name = 'san';
        $student->age = 18;
        $bool = $student->save();
        dd($bool);

        // 使用模型的Create方法新增数据
        $student = Student::create([
            'name' => 'imooc',
            'age' => 18
        ]);

        // firstOrCreate();
        // 以属性新增数据，如果数据有则找寻，如果没有则创建
        $student = Student::firstOrCreate([
            'name' => 'imooc'
        ]);

        // firstOrNew()
        // 找寻，找不到只返回属性，不会创建
        $student = Student::firstOrNew([
            'name' => 'imooc'
        ]);
        dd($student);
    

    }

    public function orm3()
    {
        $student = Student::find(20);
        $student->name = 'cc';
        $bool = $student->save();
        dd($bool);

        // 批量更新
        $num = Student::where('id', '>', '30')->update(
            ['age' => 41]
        );
        dd($num);
    }

    public function orm4()
    {
        $student = Student::find(22);
        $bool = $student->delete();
        dd($bool);

        $num = Student::destroy(10, 12);
        dd($num);

        $num = Student::where('id', '>', 44)->delete();
        dd($num);

    }

    public function request1(Request $request)
    {
        // 取值
        echo $request->input('name');
        echo $request->input('name', '未知');

        if ($request->has('name')) {
            echo $request->input('name');
        } else {
            echo '无该参数';
        }

        $res = $request->all();

        $request->method();

        if ($request->isMethod('post')) {
            echo 'post请求';
        }

        $res = $request->ajax();

        $res = $request->is('student/*');
        dd($res);
        
    }

    public function session1()
    {
        
    }

    public function session2()
    {

    }


}