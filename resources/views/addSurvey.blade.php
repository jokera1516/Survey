@extends('layout.front')

@section('content')
    <div class="col-12 mt-5">
        {!! Form::open(['method' => 'POST','action' => 'SurveyController@store']) !!}
        <div class="form-group">
            {!! Form::label('question', 'Question:') !!}
            {!! Form::text('question', null,["class"=>"form-control"]) !!}
        </div>

        <div class="form-group">
            {!! Form::label('answer0', 'Answer:') !!}
            {!! Form::text('answers[]', null,["class"=>"form-control",'id'=>'answer0']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('answer1', 'Answer:') !!}
            {!! Form::text('answers[]', null,["class"=>"form-control",'id'=>'answer1']) !!}
        </div>
        <div class="form-group prepend-btn">
            {!! Form::button('Add another answer', ["class"=>"btn btn-primary add-answer"]) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Create survey', ["class"=>"btn btn-success"]) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif