@extends('layout.front')

@section('content')
    <div class="col-12 mt-5">
    @if ($surveys->count())

        <h1>Surveys:</h1>
        <ul class="list-group">
            @foreach($surveys as $survey)
                <li class="list-group-item"><a href="/survey/{{$survey->id}}">{{$survey->question}}</a> <span class="badge badge-dark">{{$survey->totalVotes}} total votes</span> </li>
            @endforeach
        </ul>
        <br>


    @else
        <p>No Surveys found.</p>
    @endif
        <a href="/survey/create" class="btn btn-success" >Add new survey</a>
    </div>
@endsection