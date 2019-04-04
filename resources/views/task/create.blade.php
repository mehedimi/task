@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Task</div>

                    <div class="card-body">
                        @include('partials.status')

                        <form action="{!! route('tasks.store') !!}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" value="{{ old('title') }}" class="form-control{!! $errors->has('title') ? ' is-invalid' : '' !!}" placeholder="Enter title here">
                                @if($errors->has('title'))
                                    <p class="invalid-feedback">{!! $errors->first('title') !!}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="date">Last Date</label>
                                <input type="text" readonly="" value="{{ old('date') }}" name="date" class="form-control date{!! $errors->has('date') ? ' is-invalid' : '' !!}" placeholder="Enter date here">
                                @if($errors->has('date'))
                                    <p class="invalid-feedback">{!! $errors->first('date') !!}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea name="content" id="content" rows="5" class="form-control" placeholder="Enter content">{{ old('content') }}</textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
