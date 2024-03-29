i<link rel="stylesheet" type="text/css" href="css/mycss.css">
<div class="app-main__outer" >
        <div class="app-main__inner">
            <div class="app-page-title" style="background-color: lightslategrey; ">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div style='font-weight:bold;color:black;'>MANAGE EXAMINEE</div>
                    </div>
                </div>
            </div>        
            
            <div class="col-md-14" style="margin-left: -20px;">
                <div class="main-card mb-3 card">
                    <div class="card-header">Examinee List
                         <div class="search-bar">
                 <i class="fa fa-search search-icon"></i>
                <input type="text" id="search" placeholder="Enter Register Number..." oninput="searchByName()">
            </div>
                    </div>
                    
<style>
    .card-header {
        display: flex;
        justify-content: space-between; /* Align items horizontally */
        align-items: center; /* Center items vertically */
    }

    .search-bar {
        display: flex;
        align-items: center;
        margin-right: 10px; /* Adjust margin as needed */
    }

    #search {
        flex: 1;
        border: none;
        padding: 8px;
        font-size: 16px;
    }

    #search:focus {
        outline: none;
    }

    #search::placeholder {
        color: #aaa;
    }

    #search-btn {
        background-color: #4caf50;
        color: #fff;
        border: none;
        padding: 8px 12px;
        border-radius: 0 5px 5px 0;
        cursor: pointer;
    }

    #search-btn:hover {
        background-color: #45a049;
    }

    /* Add a media query for responsiveness */
    @media (max-width: 768px) {
        .card-header {
            flex-direction: column; /* Stack items vertically on smaller screens */
            align-items: stretch;
        }

        .search-bar {
            margin-top: 10px; /* Adjust margin for spacing between card-header and search bar */
        }
    }
     .search-icon {
        margin-right: 5px; /* Adjust margin for spacing between icon and input */
    }
</style>

                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
                            <thead>
                            <tr>
                                <th>Fullname</th>
                                <th>Register Number</th>
                                <th>Gender</th>
                                <th>Birthdate</th>
                                <th>Course</th>
                                <th>Year level</th>
                                <th>section</th>
                                <th>stream</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>status</th>
                                <th>action</th>
                            </tr>
                            </thead>
                            <tbody>
                              <?php 
                                $selExmne = $conn->query("SELECT * FROM examinee_tbl ORDER BY exmne_id DESC ");
                                if($selExmne->rowCount() > 0)
                                {
                                    while ($selExmneRow = $selExmne->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <tr>
                                           <td><?php echo $selExmneRow['exmne_fullname']; ?></td>
                                           <td><?php echo $selExmneRow['exmne_regno']; ?></td>
                                           <td><?php echo $selExmneRow['exmne_gender']; ?></td>
                                           <td><?php echo $selExmneRow['exmne_birthdate']; ?></td>
                                     <td>
    <?php 
        $exmne = $selExmneRow['exmne_course'];
        $selCourse = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$exmne'")->fetch(PDO::FETCH_ASSOC);
        echo $selCourse['cou_name'];
    ?>
</td>
<td><?php echo $selExmneRow['exmne_year_level']; ?></td>
<td><?php echo $selExmneRow['exmne_section']; ?></td>
<td>
    <?php 
        $cou_name = $selCourse['cou_name'];
        $selstream = $conn->query("SELECT * FROM course_tbl WHERE cou_name='$cou_name'")->fetch(PDO::FETCH_ASSOC);
        echo $selstream['stream'];
    ?>
</td>

                                           <td><?php echo $selExmneRow['exmne_email']; ?></td>
                                           <td><?php echo $selExmneRow['exmne_password']; ?></td>
                                           <td><?php echo $selExmneRow['exmne_status']; ?></td>
                                           <td>
                                               <a rel="facebox" href="facebox_modal/updateExaminee.php?id=<?php echo $selExmneRow['exmne_id']; ?>" class="btn btn-sm btn-primary">Update</a>

                                           </td>
                                        </tr>
                                    <?php }
                                }
                                else
                                { ?>
                                    <tr>
                                      <td colspan="2">
                                        <h3 class="p-3">No Course Found</h3>
                                      </td>
                                    </tr>
                                <?php }
                               ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
      
        
</div>
    
    
<script>
    function searchByName() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();
        table = document.getElementById("tableList");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1]; // Assuming name is in the second column
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) !== -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
         
