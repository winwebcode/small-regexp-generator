
@extends('\layout')
@section('content')
    <!-- Begin page content -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="/js/modal_window.js"></script>


    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Regexp generator</h1>

            <div class="container">
                <b><label>Ваше регулярное выражение готово!</label></b><br><br>
                <textarea rows="4" cols="50">{{$result}}</textarea>
            </div>

            {{--<p>{{summ:12345}}</p>--}}

        </div>
    </main>
@endsection
