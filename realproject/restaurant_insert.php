<meta charset="utf-8">
<?php
    $business = $_POST["business_number"];
	$motto = $_POST["motto"];
	$minimum_order_amount = $_POST["minimum_order_amount"];
	$delivery_tips = $_POST["delivery_tips"];
	
    $regist_day = date("Y-m-d (H:i)");
	
	$count = $_POST["count"];
	$upload_dir = "./data/$business/";

	//파일 디렉토리가 존재하지 않을 때 디렉토리 생성
	if(!is_dir($upload_dir)){
		mkdir($upload_dir);
	}

	$upfile_name	 = $_FILES["upfile"]["name"];
	$upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
	$upfile_type     = $_FILES["upfile"]["type"];
	$upfile_size     = $_FILES["upfile"]["size"];
	$upfile_error    = $_FILES["upfile"]["error"];

	if ($upfile_name && !$upfile_error)
	{
		$file = explode(".", $upfile_name);
		$file_name = $file[0];
		$file_ext  = $file[1];

		$new_file_name = date("Y_m_d_H_i_s");
		$new_file_name = $new_file_name;
		$new_file_name = $new_file_name."_".$business;
		$copied_file_name = $new_file_name.".".$file_ext;      
		$uploaded_file = $upload_dir.$copied_file_name;

		if( $upfile_size  > 10000000 ) {
				echo("
				<script>
				alert('업로드 파일 크기가 지정된 용량(10MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
				history.go(-1)
				</script>
				");
				exit;
		}

		if (!move_uploaded_file($upfile_tmp_name, $uploaded_file) )
		{
				echo("
					<script>
					alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
					history.go(-1)
					</script>
				");
				exit;
		}
	}
	else 
	{
		$upfile_name      = "";
		$upfile_type      = "";
		$copied_file_name = "";
	}

    $con = mysqli_connect("localhost", "root", "", "project");

	$sql = "insert into restaurant (business_number, motto, regist_day, minimum_order_amount, delivery_tips, order_number, file_name, file_type, file_copied) ";
    $sql .= "values('$business', '$motto', '$regist_day', '$minimum_order_amount', '$delivery_tips', 0, ";
    $sql .= "'$upfile_name', '$upfile_type', '$copied_file_name')";

	mysqli_query($con, $sql);

	//메뉴 등록 시작
	$count = $_POST["count"];
	$upload_dir = "./data/$business/menu/";

	//파일 디렉토리가 존재하지 않을 때 디렉토리 생성
	if(!is_dir($upload_dir)){
		mkdir($upload_dir);
	}

	for($i=0; $i < 5; $i++){
		$menu_name = $_POST["menu_name_$i"];
		$menu_price = $_POST["menu_price_$i"];

		if(!isset($menu_name)) break;

		$menu_image_name	 = $_FILES["menu_image_$i"]["name"];
		$menu_image_tmp_name = $_FILES["menu_image_$i"]["tmp_name"];
		$menu_image_type     = $_FILES["menu_image_$i"]["type"];
		$menu_image_size     = $_FILES["menu_image_$i"]["size"];
		$menu_image_error    = $_FILES["menu_image_$i"]["error"];

		if ($menu_image_name && !$menu_image_error)
		{
			$file = explode(".", $menu_image_name);
			$file_name = $file[0];
			$file_ext  = $file[1];

			$new_file_name = date("Y_m_d_H_i_s");
			$new_file_name = $new_file_name;
			$new_file_name = $new_file_name."_".$i;
			$copied_file_name = $new_file_name.".".$file_ext;      
			$uploaded_file = $upload_dir.$copied_file_name;
			
			if( $menu_image_size  > 10000000 ) {
					echo("
					<script>
					alert('업로드 파일 크기가 지정된 용량(10MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
					history.go(-1)
					</script>
					");
					exit;
			}

			if (!move_uploaded_file($menu_image_tmp_name, $uploaded_file) )
			{
					echo("
						<script>
						alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
						history.go(-1)
						</script>
					");
					exit;
			}
		}
		else 
		{
			$menu_image_name      = "";
			$menu_image_type      = "";
			$copied_file_name = "";
		}

		$sql = "insert into restaurant_menu (business_number, menu_name, menu_price, regist_day, file_name, file_type, file_copied) ";
		$sql .= "values('$business', '$menu_name', '$menu_price', '$regist_day', ";
		$sql .= "'$menu_image_name', '$menu_image_type', '$copied_file_name')";
	
		mysqli_query($con, $sql);
		sleep(2);
	}

    mysqli_close($con);//DB 연결 끊기

    echo "
	      <script>
	          location.href = 'main.php';
	      </script>
	  ";
?>

   
