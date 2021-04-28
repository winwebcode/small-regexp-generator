
@extends('\layout')
@section('content')
    <!-- Begin page content -->




    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Генератор регулярных выражений</h1>

            <div class="container">
                <div class="alert alert-info" role="alert">
                    <p>Данный скрипт сгенерирует регулярное выражение за вас в случае не очень сложных кейсов, например, выдернуть все ссылки / картинки на странице, выбрать все ID или параметры из ссылок.<br>
                        Любое из полей может быть пустым.
                    </p>
                </div>
{{Form::open(['route' => 'regexp.create', 'method' => 'post']) }}
                <b><label>Перед искомым текстом всегда есть (допустим перед ссылкой есть href=")</label></b><br>
                <input type="tex" size="50" placeholder="Перед искомым текстом всегда есть" name="beforeText"><br><br>
                <b><label>Искомый текст всегда начинается с (ссылка начинается с http)</label></b><br>
                <input type="text" size="50" placeholder="Искомый текст всегда начинается с" name="textStart"><br><br>
                <b><label>Это идёт после искомого текста (после ссылки всегда есть ">)</label></b><br>
                <input type="text" size="50" placeholder="Это идёт после искомого текста" name="afterText"><br><br>
                <b><label>Этим заканчивается искомый текст (Это может быть расширение страницы в ссылке если оно есть или ничего)</label></b><br>
                <input type="text" size="50" placeholder="Этим заканчивается искомый текст" name="textFinish"><br><br>
                <b><label>Разрешить переносы текста</label></b><br>
                <input type="checkbox" name="textWrap" unchecked><br><br>
                <b><label>Самое короткое совпадение</label></b><br>
                <input type="checkbox" name="shortestMatch" unchecked><br><br>

                <textarea id="your_regex" cols="30" rows="5"></textarea><br>
                <button type="submit" onclick="genRegexp()">Generate</button><br>
            </div>
{{Form::close()}}



<!--ajax -->
<script>

        function genRegexp() {

            $.ajax({
                url: '{{ route("regexp.create") }}',
                type: 'POST',
                data: {
                    beforeText: document.getElementsByName("beforeText").value,
                    textStart: document.getElementsByName("textStart").value,
                    afterText: document.getElementsByName("afterText").value,
                    textFinish: document.getElementsByName("textFinish").value,
                    textWrap: document.getElementsByName("textWrap").value,
                    shortestMatch: document.getElementsByName("shortestMatch").value,
                    _token: '{{csrf_token()}}',
                },
               // dataType: 'JSON',
                success: function (responce) {
                    console.log(responce);
                    document.getElementById("your_regex").value = responce;
                },
                error: function (err) {
                    console.log('Я Ajax, а ты нихера не получишь!');
                },
            });

        }

</script>



        </div>
    </main>
@endsection
