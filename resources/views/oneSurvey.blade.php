@extends('layout.front')
@php
 //dd(Cookie::get('answered'));
@endphp
@section('content')
    <div class="col-12 mt-5">
        @php
            $answeredSurveyArray=explode(',',Cookie::get('answered'));
           // dd(Cookie::get('answered'),$answeredSurveyArray);
        @endphp
    @if(in_array($survey->id,$answeredSurveyArray))
            <div>

                <p><strong>You already voted. These are all the results</strong></p>
                <p><strong>Total votes:</strong> {{$survey->totalVotes}}</p>
                <h3>{{$survey->question}}</h3>
                @foreach($survey->answers as $answer)
                    <p> &bull; {{$answer->name}} <span class="badge badge-info"> {{number_format(($answer->votes*100)/$survey->totalVotes,2)}}% of votes</span></p>
                @endforeach


            </div>
    @else

            {!! Form::open(['method' => 'POST','action' => ['SurveyController@vote',$survey->id]]) !!}
            <h2 class="mb-3"><strong>Question:</strong> {{$survey->question}}</h2>
            @foreach($survey->answers as $i => $answer)
                <div class="form-group">
                    {{ Form::radio("answer", $answer->id, ( $i==0 )? true : false ,['id'=>"answer$i"]) }}
                    {{ Form::label("answer$i", $answer->name) }}
                </div>

            @endforeach

            <div class="form-group">
                {!! Form::submit('Vote', ["class"=>"btn btn-primary"]) !!}
            </div>
            {!! Form::close() !!}
    @endif
    </div>
@endsection