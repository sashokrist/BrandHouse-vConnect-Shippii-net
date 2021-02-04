@extends('templates.default')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">Poll</h1>
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
                        <form action="{{ route('questionnaires') }}" method="post">
                            @csrf
                            <div class="form-group">
                                Title: <input type="text" name="title" class="form-control" placeholder="title">
                            </div>
                            <div class="form-group">
                                Purpose: <input type="text" name="purpose" class="form-control" placeholder="purpose">
                            </div>
                            <button type="submit" class="btn btn-primary">Create Questionnaire</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>


@endsection
