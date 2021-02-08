@extends('templates.default')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">Questionnaires</h1>
                    </div>
                    <div class="card-body">
                        <hr>
                        <a href="{{ route('questionnaires/create') }}" class="btn btn-primary">New Questionnaire</a>
                        <hr>
                        <div class="col-md-8">
                            <ul class="list-group">
                                @foreach($questionnaires as $questionnaire)
                                    <li class="list-group-item">
                                        <a href="{{ $questionnaire->path() }}"><h2>{{ $questionnaire->title }}</h2></a>
                                        <a href="{{ $questionnaire->path() }}"> <h4>{{ $questionnaire->purpose }}</h4></a>
                                        <div class="mt-2">
                                            <small>Share URL</small>
                                            <p>
                                                <a href="{{ $questionnaire->publicPath() }}">{{ $questionnaire->publicPath() }} </a>
                                            </p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                    </div>
                </div>
            </div>

        </div>


@endsection
