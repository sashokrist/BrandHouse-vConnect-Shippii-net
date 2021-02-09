@extends('templates.default')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">{{ $questionnaire->title }}</h1>
                    </div>
                    <div class="card-body">
                        Purpose: <h3>{{ $questionnaire->purpose }}</h3><br>
                        <hr>
                        <a href="/questionnaires/{{ $questionnaire->id }}/questions/create" class="btn btn-primary">Add Question</a>
                        <a href="/surveys/{{ $questionnaire->id }}-{{ Str::slug($questionnaire->title) }}" class="btn btn-primary">Take Survey</a>
                    </div>
                </div>

                @foreach($questionnaire->questions as $question)
                    <div class="card">
                        <div class="card-header">
                            <h1 class="text-center">{{ $question->question }}</h1>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach($question->answers as $answer)
                                    <li class="list-group-item d-flex justify-content-right">
                                        <div>
                                            {{ $answer->answer }}
                                        </div>
                                        @if($question->response->count())
                                        <div>
                                            {{ intval($answer->response->count()  * 100 / $question->response->count())  }} %
                                        </div>
                                            @endif
                                        </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="card-footer">
                            <form action="/questionnaires/{{ $questionnaire->id }}/questions/{{ $question->id }}" method="post">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">Delete question</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>


@endsection
