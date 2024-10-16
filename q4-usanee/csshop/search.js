var httpRequest;
function search(){
    httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = query;

    var keyword = document.getElementById("search-keyword").value;
    // console.log(keyword);
    var url = "search.php?keyword=" +keyword;

    httpRequest.open("GET",url);
    httpRequest.send();
}

function query(){
    if(httpRequest.readyState == 4 && httpRequest.status == 200){
        document.getElementById("result").innerHTML = httpRequest.responseText;
        document.getElementById("allmember").style.display = "none";
    }
}