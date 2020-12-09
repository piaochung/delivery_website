var count=0;

function addMenuForm() {
    var addedFormDiv = document.getElementById("addedKeyword");

    if(count < 5){
        var str = `<b>메뉴 이미지</b><br/><input type="file" name="menu_image_${count}"/><br/><b>메뉴 이름</b><br/><input type="text" name="menu_name_${count}"/><br/><b>메뉴 가격</b><br/><input type="number" name="menu_price_${count}"/><hr/>`;
        var addForm = document.createElement("div");
        addForm.setAttribute("id", "menu_form");
        addForm.innerHTML = str;9-
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

function check_input() {
    if (!document.regist_form.upfile.value)
    {
      alert("배너 이미지를 등록해주세요");    
      document.regist_form.motto.focus();
      return;
    }

    if (!document.regist_form.motto.value)
    {
      alert("사장님의 다짐을 입력해주세요");    
      document.regist_form.motto.focus();
      return;
    }

    if(!document.regist_form.minimum_order_amount.value)
    {
      alert("최소 주문 금액을 입력해주세요");
      document.regist_form.minimum_order_amount.focus();
      return;
    }

    if(!document.regist_form.delivery_tips.value)
    {
      alert("주문팁을 입력해주세요");
      document.regist_form.delivery_tips.focus();
      return;
    }

    if(!document.regist_form.delivery_tips.value)
    {
      alert("주문팁을 입력해주세요");
      document.regist_form.delivery_tips.focus();
      return;
    }
/*
    for(var i=0; i < count; i++){
        if(`!document.regist_form.menu_image_${i}.value`){
          alert(i + "이미지");
          return;
        }
        
        if(`!document.regist_form.menu_name_${i}.value`){
          alert(i + "이름");
          return;
        }
        
        if(`!document.regist_form.menu_price_${i}.value`){
          alert(i + "가격");
          return;
        }
       
    }
 */
    document.member_form.submit();
  }

  function check_menu1(){
     
    if(!document.regist_form.menu_image_0.value){
      alert(i + "이미지");
      return;
    }
    
    if(!document.regist_form.menu_name_0.value){
      alert(i + "이름");
      return;
    }
    
    if(!document.regist_form.menu_price_0.value){
      alert(i + "가격");
      return;
    }
  }