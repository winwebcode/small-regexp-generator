
@extends('\layout')
@section('content')
    <!-- Begin page content -->


    <meta name="csrf-token" content="{{ csrf_token() }}">
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Генератор регулярных выражений</h1>

            <div class="container">
                <div class="alert alert-info" role="alert">
                    <p>Данный скрипт сгенерирует регулярное выражение за вас в случае не очень сложных кейсов, например, выдернуть все ссылки / картинки на странице, выбрать все ID или параметры из ссылок.<br>
                        Любое из полей может быть пустым.
                    </p>
                </div>

                <b><label>Перед искомым текстом всегда есть (допустим перед ссылкой есть href=")</label></b><br>
                <input type="text" size="50" placeholder="Перед искомым текстом всегда есть" id="beforeText"><br><br>
                <b><label>Искомый текст всегда начинается с (ссылка начинается с http)</label></b><br>
                <input type="text" size="50" placeholder="Искомый текст всегда начинается с" id="textStart"><br><br>
                <b><label>Это идёт после искомого текста (после ссылки всегда есть ">)</label></b><br>
                <input type="text" size="50" placeholder="Это идёт после искомого текста" id="afterText"><br><br>
                <b><label>Этим заканчивается искомый текст (Это может быть расширение страницы в ссылке если оно есть или ничего)</label></b><br>
                <input type="text" size="50" placeholder="Этим заканчивается искомый текст" id="textFinish"><br><br>
                <b><label>Разрешить переносы текста</label></b><br>
                <input type="checkbox" id="textWrap" unchecked><br><br>
                <b><label>Самое короткое совпадение</label></b><br>
                <input type="checkbox" id="shortestMatch" unchecked><br><br>

                <textarea id="your_regex" cols="30" rows="5"></textarea><br>
                <button type="submit" onclick="genRegexp()">Generate</button><br>
            </div>
        </div>
    </main>

    <script>
        function genRegexp()
        {
            let beforeText = document.getElementById("beforeText").value;
            let textStart = document.getElementById("textStart").value;
            let afterText = document.getElementById("afterText").value;
            let textFinish = document.getElementById("textFinish").value;
            let textWrap = document.getElementById("textWrap").checked;
            let shortestMatch = document.getElementById("shortestMatch").checked;
            let url = '{{ route("regexp.create") }}' + '?' + 'beforeText=' + beforeText + '&textStart=' + textStart + '&afterText=' + afterText
                + '&textFinish=' + textFinish + '&textWrap=' + textWrap + '&shortestMatch=' + shortestMatch;
            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            let data = new FormData();
            data.append("beforeText", beforeText);
            data.append("textStart", textStart);
            data.append("afterText", afterText);
            data.append("textFinish", textFinish);
            data.append("textWrap", textWrap);
            data.append("shortestMatch", shortestMatch);

            let xhr = new XMLHttpRequest();
            xhr.withCredentials = true;
            xhr.open("POST", url);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.setRequestHeader("Accept", "application/json, text-plain, *!/!*");
            xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
            xhr.setRequestHeader("X-CSRF-TOKEN", token);
            xhr.send(data);
            xhr.addEventListener("readystatechange", function () {
                if (this.readyState === 4) {
                    setResult(this.responseText);
                }
            });
        }

        function setResult(responseText)
        {
            document.getElementById("your_regex").innerHTML = responseText;
        }
    </script>
@endsection
