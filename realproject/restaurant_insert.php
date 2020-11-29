<meta charset="utf-8">
<?php
    $business = $_POST["business_number"];
    $motto = $_POST["motto"];

    $regist_day = date("Y-m-d (H:i)");

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
		$new_file_name = $business + $new_file_name;
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

	$sql = "insert into restaurant (business_number, motto, regist_day, order_number, file_name, file_type, file_copied) ";
    $sql .= "values('$business', '$motto', '$regist_day', 0, ";
    $sql .= "'$upfile_name', '$upfile_type', '$copied_file_name')";

	mysqli_query($con, $sql);
    mysqli_close($con);     

    echo "
	      <script>
	          location.href = 'main.php';
	      </script>
	  ";
?>

   
