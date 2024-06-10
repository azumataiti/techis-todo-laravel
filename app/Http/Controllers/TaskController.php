<?php
//オブジェクト指向を確認する
// userのレコードを出したい場合等public function index(Request $request)の{}内の処理、use App\Models\Task;内のTask,
// class TaskController extends Controller内のTaskControllerを変える必要がある。
// →Model,Controllerにそれぞれuserファイルを作成してtable同士の紐づけを行う
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;

use App\Repositories\TaskRepository;



class TaskController extends Controller
{
    /**
        * タスクリポジトリ
        *
        * @var TaskRepository
        */
        protected $tasks;



    /**
     * コンストラクタ：自動的に呼び出される初期化処理用のメソッド/認証機能をこのファイルで有効にするために記述している
     * 
     * @return void
     */
    public function __construct(TaskRepository $ts)
    {
        $this->middleware('auth');

        $this->tasks = $ts;
    }

    /**
        * タスク一覧
        *
        * @param Request $request
        * @return Response
        */
    public function index(Request $request)
    {
        //$tasks = Task::orderBy('created_at', 'asc')->get();
        //$tasks = $request->user()->tasks()->get();//$request->user()で認証済みのuserを取得。そのuserが取得するタスク一覧を取得。
        $v = 'tasks.index';
        $t = $this->tasks->forUser($request->user());
        return view($v, [
            'tasks' => $t,
        ]);
    }

/**
        * タスク登録
        *
        * @param Request $request
        * @return Response
        */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        // タスク作成
        //Task::create([
        //    'user_id' => 0,
        //  'name' => $request->name
        //]);
        $request->user()->tasks()->create([
            'name' => $request ->name,
        ]);

        return redirect('/tasks');
    }
    /**
        * タスク削除
        *
        * @param Request $request
        * @param Task $task
        * @return Response
        */
    public function destroy(Request $request, Task $task)
    {
        $i = 1;
        $s = "test";

        $this ->authorize('destroy', $task);

        $task->delete();
        return redirect('/tasks');
    }
}
