
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
                <input type="text" placeholder="Перед искомым текстом всегда есть" name="beforeText"><br><br>
                <input type="text" placeholder="Искомый текст всегда начинается с" name="textStart"><br><br>
                <input type="text" placeholder="Это идёт после искомого текста" name="afterText"><br><br>
                <input type="text" placeholder="Этим заканчивается искомый текст" name="textFinish"><br><br>
                <button type="submit">Generate</button><br>
            </div>



        </div>
    </main>
@endsection
