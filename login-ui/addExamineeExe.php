<?php 
 include("conn.php");


extract($_POST);

$selExamineeFullname = $conn->query("SELECT * FROM examinee_tbl WHERE exmne_fullname='$fullname' ");
$selExamineeEmail = $conn->query("SELECT * FROM examinee_tbl WHERE exmne_email='$email' ");


if($gender == "0")
{
	$res = array("res" => "noGender");
}
else if($course == "0")
{
	$res = array("res" => "noCourse");
}
else if($year_level == "0")
{
	$res = array("res" => "noLevel");
}
else if($selExamineeFullname->rowCount() > 0)
{
	$res = array("res" => "fullnameExist", "msg" => $fullname);
}
else if($selExamineeEmail->rowCount() > 0)
{
	$res = array("res" => "emailExist", "msg" => $email);
}
else
{
	$insData = $conn->query("INSERT INTO examinee_tbl(exmne_fullname,exmne_regno,exmne_course,exmne_gender,exmne_birthdate,exmne_year_level,exmne_section,exmne_email,exmne_password) VALUES('$fullname','$regno','$course','$gender','$bdate','$year_level','$Section','$email','$password')  ");
	if($insData)
	{
		$res = array("res" => "success", "msg" => $email);
	}
	else
	{
		$res = array("res" => "failed");
	}
}


//echo json_encode($res);
 ?>
<script>
    // Get the response from the PHP script
    var response = <?php echo json_encode($res); ?>;

    // Check the response
    if(response.res == "noGender")
    {
        alert("Please select a gender.");
    }
    else if(response.res == "noCourse")
    {
        alert("Please select a course.");
    }
    else if(response.res == "noLevel")
    {
        alert("Please select a year level.");
    }
    else if(response.res == "fullnameExist")
    {
        alert("The name " + response.msg + " already exists.");
    }
    else if(response.res == "emailExist")
    {
        alert("The email " + response.msg + " already exists.");
    }
    else if(response.res == "success")
    {
        alert("Registration successful.");
        window.location.href = "register.php"; // redirect to success page
    }
    else
    {
        alert("Registration failed.");
         window.location.href = "register.php"; // redirect to success page
    }
</script>
