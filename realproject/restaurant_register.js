var count=0;

function addMenuForm() {
    var addedFormDiv = document.getElementById("addedKeyword");
    var str = '<b>메뉴 이미지</b><br/><input type="file" name="menu_image"/><br/><b>메뉴 이름</b><br/><input type="text" name="menu_name"/><br/><b>메뉴 가격</b><br/><input type="text" name="menu_price"/><hr/>';

    if(count < 5){
        var addForm = document.createElement("div");
        addForm.setAttribute("id", "menu_form" + count);
        addForm.innerHTML = str;
        addedFormDiv.appendChild(addForm);

        count++;
    } else {
        alert("메뮤는 5개까지 추가할 수 있습니다.");
    }
}