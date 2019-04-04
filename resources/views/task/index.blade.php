@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <p class="mb-0">Tasks</p>
                <p class="mb-0">
                    @if(request()->has('complete'))
                        <a href="?" class="btn btn-success">Incomplete</a>
                    @else
                        <a href="?complete=true" class="btn btn-info text-white">Complete</a>
                    @endif
                </p>
                <p class="mb-0">
                    <a href="{!! route('tasks.create') !!}" class="btn btn-primary">Create</a>
                </p>
            </div>

            <div class="card-body">
                @include('partials.status')
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Days Remain</th>
                                <th>Date</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->content }}</td>
                                <td>{{ $task->date->diffForHumans() }}</td>
                                <td>{{ $task->date->format('d F, Y') }}</td>
                                <td class="d-flex">
                                    <a href="{!! route('tasks.edit', $task) !!}" class="btn btn-info btn-sm text-white mr-1">Edit</a>
                                    <form method="post"  action="{!! route('tasks.status', $task) !!}">
                                        @method('PATCH')
                                        @csrf
                                        @if($task->is_complete)
                                            <input type="hidden" name="status" value="0">
                                            <button class="btn btn-primary btn-sm mr-2">Mark As InComplete</button>
                                            @else
                                            <input type="hidden" name="status" value="1">
                                            <button class="btn btn-success btn-sm text-white mr-2">Mark As Complete</button>
                                        @endif
                                    </form>
                                    <form method="post" onsubmit="return confirm('Are you sure ? \nDelete this task?');" action="{!! route('tasks.destroy', $task) !!}">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger btn-sm text-white">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $tasks->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
