<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    // 首页
    public function index()
    {
        return view('admin/comment/index')->withComments(Comment::all());
    }

    // 修改
    public function edit($id)
    {
        return view('admin/comment/edit')->withComments(Comment::with('hasOneArticle')->find($id));
    }

    // 存储数据
    public function update(Request $request)
    {
        $this->validate($request, [
            'nickname' => 'required|max:255',
            'content' => 'required',
        ]);

        $comment = Comment::find($request->get('id'));
        $comment->nickname = $request->get('nickname');
        $comment->email = $request->get('email');
        $comment->website = $request->get('website');
        $comment->content = $request->get('content');

        if ($comment->save()) {
            return redirect('admin/comment');
        } else {
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }

    // 删除数据
    public function destroy($id)
    {
        Comment::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功！');
    }
}
