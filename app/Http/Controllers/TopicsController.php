<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Models\Category;
use App\Models\Topic;
use App\Models\User;
use App\Models\Link;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use Auth;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Request $request, Topic $topic, User $user, Link $link)
	{
		$topics = $topic->withOrder($request->order)->paginate(30);
		$active_users = $user->getActiveUsers();
		$links = $link->getAllCached();

		return view('topics.index', compact('topics', 'active_users', 'links'));
	}

    public function show(Request $request, Topic $topic)
    {
        // URL 纠正
        if ( ! empty($topic->slug) && $topic->slug != $request->slug) {
            return redirect($topic->link(), 301);
        }

        return view('topics.show', compact('topic'));
    }

	public function create(Topic $topic)
	{
        $categories = Category::all();
		return view('topics.create_and_edit', compact('topic', 'categories'));
	}

	public function store(TopicRequest $request, Topic $topic)
	{
	    $topic->fill($request->all());
	    $topic->user_id = Auth::id();
	    $topic->save();
		return redirect()->to($topic->link())->with('message', '添加话题成功');
	}

	public function edit(Topic $topic)
	{
        $this->authorize('update', $topic);

        $categories = Category::all();
		return view('topics.create_and_edit', compact('topic', 'categories'));
	}

	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->update($request->all());

		return redirect()->to($topic->link())->with('message', '更新成功');
	}

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topics.index')->with('message', '成功删除！');
	}

	public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
        // 初始化返回数据，默认是失败的
        $data = [
            'success'   => false,
            'msg'       => '上传失败',
            'file_path' => ''
        ];

        // 判断是否有文件上传，并赋值给 $file
        if ($file = $request->upload_file) {
            // 保存图片到本地
            $result = $uploader->save($request->upload_file, 'topics', Auth::id(), 1024);
            // 图片保存成功的话
            if ($result) {
                $data['file_path']  = $result['path'];
                $data['msg']        = '上传成功！';
                $data['success']    = true;
            }
        }
        return $data;
    }
}