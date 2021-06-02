@extends('templates.default')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">Poll</h1>
                    </div>
                                <form action="{{ route('event/vote/store') }}" method="post">
                                    @csrf
                                    <h2 class="text-center">{{ $poll->title }}</h2>

                                    @foreach($poll->answer as $answer)
                                        <div class="form-check text-center">
                                            <input class="form-check-input" type="checkbox" value="{{ $answer->answer }}" id="flexCheckChecked">
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
            </div>
@endsection

