<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Session;
use Storage;

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

    // Request 操作
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

    public function session1(Request $request)
    {
        // 1.HTTP request session()
        // $request->session()->put('key1', 'value1');
        // $request->session()->get('key1');

        // session()
        // session()->put('key2', 'value2');
        // session()->get('key2');

        // 存储数据到Session
        Session::put('key3', 'value3');
        
        // 获取Session的值
        Session::get('key3');
        // 不存在取默认值
        Session::get('key4', 'default');

        // 已数组的形式存储数据
        Session::put(['key4' => 'value4']);

        // 把数据放到Session的数组中
        Session::push('student', 'sean');
        Session::push('student', 'dom');

        // 取出数据并删除
        Session::pull('student', 'default');

        // 判断
        Session::has('key11');
    
        // 删除Session中指定key的值
        Session::forget('key3');

        // 清空所以session信息
        Session::flush();
    }

    public function session2(Request $request)
    {
        dd(session()->all());
    }

    public function response()
    {
        $data = [
            'errCode'   => 0,
            'errMsg'    => 'success',
            'data'      => 'sean',
        ];

        reponse()->json($data);

        // 重定向
        return redirect('session2')->with('message', '我是快闪数据');

        // action()
        return redirect()->action('Student@session2');

        // route()
        return redirect()->route('session2')->with('message', '我是快闪数据');

        return redirect()->back();


    }

    // 活动的宣传页面
    public function activity0()
    {
        return '活动快要开始啦，敬请期待';
    }
    
    public function activity1()
    {
        return '活动进行中，谢谢您的参与1';
    }
    public function activity2()
    {
        return '活动进行中，谢谢您的参与2';
    }

    public function upload(Request $request)
    {
        if ($request->isMethod('POST')) {
            $file =  $request->file('source');
            
            // 文件是否上传成功
            if ($file->isValid()) {
                // 原文件名
                $originalName = $file->getClientOriginalName();
                // 扩展名
                $ext = $file->getClientOriginalExtension();
                // MimeType
                $type = $file->getClientMimeType();
                // 临时绝对路径
                $realPath = $file->getRealPath();

                $filename = date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext;

                $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));

                
            }
            exit;
        }
        return view('students.upload');
    }

}