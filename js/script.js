var keyword = document.getElementById('search');
var orderDetail = document.getElementById('order');

keyword.addEventListener('keyup', function(){
    console.log(keyword.value);
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if (xhr.readyState == 4 && xhr.status == 200) {
            orderDetail.innerHTML = xhr.responseText;
        }
    }

    xhr.open('GET', 'search.php?search=' + keyword.value, true);
    xhr.send();

})