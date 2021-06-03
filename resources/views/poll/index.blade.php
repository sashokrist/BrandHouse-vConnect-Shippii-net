@extends('templates.default')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="card-header">
                        <h1 class="text-center">Poll</h1>
                    </div>
                                <form action="{{ route('poll/result/store') }}" method="post">
                                    @csrf
                                    <h2 class="text-center">{{ $poll->title }}</h2>
                                    <input type="hidden" name="poll_id" value="{{ $poll->id }}">
                                    @foreach($poll->answer as $answer)
                                        <div class="form-check text-center">
                                            <input type="checkbox" class="form-check-input" name="answer[]" value="{{ $answer->answer }}" multiple>
                                            <label class="form-check-label" for="flexCheckChecked">
                                                {{ $answer->answer }}
                                            </label>
                                        </div>
                                    @endforeach
                                    <button type="submit" class="btn btn-primary center-block">Vote</button>
                                </form>
                            </div>
                        </div>
                </div>
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">User</th>
                    <th scope="col">Answer</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($results as $result)
                    <tr>
                        <td>{{ $result->user->username }}</td>
                        <td>{{ $result->answer }}</td>
                        <td>
                            @if (auth()->user()->username ===  $result->user->username)
                                <form action="" method="post">
                                    @csrf
                                    <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                                    <button type="submit" class="btn btn-danger pull-right">Delete</button>
                                </form>
                            @else
                                <button type="submit" class="btn btn-danger pull-right" disabled>Delete
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
            </div>
@endsection

