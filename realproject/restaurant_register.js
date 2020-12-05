var count=0;

function addMenuForm() {
    var addedFormDiv = document.getElementById("addedKeyword");

    if(count < 5){
        var str = `<b>메뉴 이미지</b><br/><input type="file" name="menu_image_${count}"/><br/><b>메뉴 이름</b><br/><input type="text" name="menu_name_${count}"/><br/><b>메뉴 가격</b><br/><input type="number" name="menu_price_${count}"/><hr/>`;
        var addForm = document.createElement("div");
        addForm.setAttribute("id", "menu_form");
        addForm.innerHTML = str;
        addedFormDiv.appendChild(addForm);
        count++;
    } else {
        alert("메뉴는 5개까지 추가할 수 있습니다.");
    }
}

function addCount() {
    var addedFormDiv = document.getElementById("count_check");
    var str =`<input type="hidden" name="count" value=${count}/>`;
    var addForm = document.createElement("div");
    addForm.innerHTML = str;
    addForm.appendChild(addedFormDiv);
}