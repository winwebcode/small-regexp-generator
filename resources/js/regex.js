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
