<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

//to obtain logged user
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
   
  //To protect from non logged
  public function __construct()
  {
      $this->middleware('auth', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'complete']]);
  }
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        $tasks_completed = $user->tasks()->completed()->get();
        $tasks_pending = $user->tasks()->pending()->get();
        return view ('tasks.index', ['tasks_completed' => $tasks_completed, 'tasks_pending' => $tasks_pending]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $task = new Task;
        return view('tasks.create', ['task' => $task]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //create new task
        $task = new Task;
        //associate values from the view form
        $task->name = $request->name;
        $task->description = $request->description;
        $task->completed = false;
        //retrieve logged user
        $user = Auth::user();
        //associate user to the new task to fill the user_id column in table
        $task->user()->associate($user);
        //save task in database and redirect
        $task->save();

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $task = Task::findOrFail($id);
        return view('tasks.show', ['task'=> $task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $task = Task::findOrFail($id);
        return view('tasks.edit', ['task'=> $task]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $task = Task::findOrFail($id);
        $task->name = $request->name;
        $task->description = $request->description;
        $task->completed = false;
        //link with user
        $user = Auth::user();
        $task->user()->associate($user);

        $task->save();
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->route('tasks.index');
    }

    public function complete($id)
    {
        //
        $task = Task::findOrFail($id);

        $task->completed = true;
        $task->save();
        return redirect()->route('tasks.index');
    }
}
