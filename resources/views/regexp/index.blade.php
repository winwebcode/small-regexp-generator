
@extends('\layout')
@section('content')
    <!-- Begin page content -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="/js/modal_window.js"></script>


    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Regexp generator</h1>
{{Form::open(['route' => 'regexp.create', 'method' => 'post']) }}
            <div class="container">
                <input type="tex" size="50" placeholder="Перед искомым текстом всегда есть" name="beforeText"><br><br>
                <input type="text" size="50" placeholder="Искомый текст всегда начинается с" name="textStart"><br><br>
                <input type="text" size="50" placeholder="Это идёт после искомого текста" name="afterText"><br><br>
                <input type="text" size="50" placeholder="Этим заканчивается искомый текст" name="textFinish"><br><br>
                <label>Разрешить переносы текста</label><br><br>
                <input type="checkbox" name="textWrap" unchecked><br><br>
                <label>Самое короткое совпадение</label><br><br>
                <input type="checkbox" name="shortestMatch" unchecked><br><br>
                <button type="submit">Generate</button><br>
            </div>
{{Form::close()}}


        </div>
    </main>
@endsection
