var count=0;

function addKeywordForm() {
    var addedFormDiv = document.getElementById("addedKeyword");
    var str = '<b>메뉴 이미지</b><br/><input type="file" name="menu_image"/><br/><b>메뉴 이름</b><br/><input type="text" name="menu_name"/><br/><b>메뉴 가격</b><br/><input type="text" name="menu_price"/><hr/>';

    if(count < 5){
        var addedDiv = document.createElement("div");
        addedDiv.setAttribute("id", "keyword_form" + count);
        addedDiv.innerHTML = str;
        addedFormDiv.appendChild(addedDiv);

        count++;
    } else {
        alert("Keyword는 5개까지 입력할 수 있습니다.");
    }
}