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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="/surveys/{{ $questionnaire->id }}-{{ Str::slug($questionnaire->title) }}"
                              method="post">
                            @csrf
                            @foreach($questionnaire->questions as $key => $question)
                                <div class="card">
                                    <div class="card-header">
                                        <h1 class="text-center"><strong>{{ $key + 1 }}
                                                - </strong>{{ $question->question }}</h1>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group">
                                            @foreach($question->answers as $answer)
                                                <li class="list-group-item">
                                                    <label for="answer{{ $answer->id }}">
                                                        <input type="radio" name="responses[{{ $key }}][answer_id]"
                                                               id="answer{{ $answer->id }}"
                                                               {{ (old('responses.'.$key.'.answer_id') === $answer->id) ? 'checked' : '' }}
                                                               value="{{ $answer->id }}" class="ml-2">
                                                        {{ $answer->answer }}
                                                    </label>
                                                    <input type="hidden" name="responses[{{ $key }}][question_id]"
                                                           value="{{ $question->id }}">
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endforeach

                            <div class="card">
                                <div class="card-header">
                                    <h1 class="text-center">Your Information</h1>
                                </div>
                                <div class="card-body">
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="control-label">Your email address</label>
                                        <input type="text" name="survey[email]" class="form-control" id="email">
                                        @if ($errors->has('email'))
                                            <span class="help-block">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                        <label for="name" class="control-label">Choose a name</label>
                                        <input type="text" name="survey[name]" class="form-control" id="name">
                                        @if ($errors->has('username'))
                                            <span class="help-block">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Complete Survey</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
