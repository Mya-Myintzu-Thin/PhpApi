<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tasks;

Route::group(['middleware' => ['web']], function () {
    
    // Show Task Dashboard
    
    Route::get('/', function () {
        return view('tasks', [
            'tasks' => Tasks::orderBy('created_at', 'asc')->get()
        ]);
    });

    
    //  Add New Task
    
    Route::post('/task', function (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $task = new Tasks;
        $task->name = $request->name;
        $task->save();

        return redirect('/');
    });

    
    //  Delete Task
    
    Route::delete('/task/{id}', function ($id) {
        Tasks::findOrFail($id)->delete();

        return redirect('/');
    });
});
