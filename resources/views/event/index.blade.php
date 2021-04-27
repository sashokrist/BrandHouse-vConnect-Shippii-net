@extends('templates.default')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">Event</h1>
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
                        @if(auth()->user()->isAdmin === 1)
                            <a href="{{ route('event/create') }}" class="btn btn-primary center-block">New
                                Event</a>
                        @endif
                    </div>
                    @if($event !== null)
                    <div class="col-md-12">
                        <h2 class="text-center">{{ $event->event_title }}</h2>
                        <div class="col-md-12">
                            <form action="{{ route('event/signup/store') }}" method="post">
                                @csrf
                                <input type="hidden" name="signup_id" value="{{ $event->id }}">
                                <button type="submit" class="btn btn-primary center-block">Sign up for {{ $event->event_title }}</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col" class="pull-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($eventSignUps as $item)
                            <tr>

                                    <td>{{ $item->user_id }}</td>
                                    <td>
                                        <form action="">
                                            @csrf
                                            <button type="submit" class="btn btn-danger pull-right">Delete</button>
                                        </form>
                                    </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @else
                    <h2>No event yet</h2>
                @endif
            </div>
        </div>
@endsection
