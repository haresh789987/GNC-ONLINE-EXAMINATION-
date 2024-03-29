<div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div>MANAGE EXAM</div>
                    </div>
                </div>
            </div>        
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">EXAM List
                        <div class="search-bar">
                 <i class="fa fa-search search-icon"></i>
                <input type="text" id="search" placeholder="Enter Course Name..." oninput="searchByName()">
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
                                <th class="text-left pl-4">Exam Title</th>
                                <th class="text-left ">Course</th>
                                 <th class="text-left ">stream</th>
                                <th class="text-left ">Description</th>
                                <th class="text-left ">Time limit</th>  
                                <th class="text-left ">Display limit</th>  
                                <th class="text-center" width="20%">Action</th>
                                 <th class="text-left ">current status</th>  
                                <th class="text-left ">status</th>  
                            </tr>
                            </thead>
                            <tbody>
                              <?php 

                                $selExam = $conn->query("SELECT * FROM exam_tbl ORDER BY ex_id DESC ");
                                                                  

                       
                             if($selExam->rowCount() > 0)
                                {
                                    while ($selExamRow = $selExam->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <tr>
                                            <td class="pl-4"><?php echo $selExamRow['ex_title']; ?></td>
                                            <td>
    <?php 
        $courseId =  $selExamRow['cou_id']; 
        $selCourse = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$courseId' ");
        while ($selCourseRow = $selCourse->fetch(PDO::FETCH_ASSOC)) {
            echo $selCourseRow['cou_name'];
        }
    ?>
</td>
<td>
    <?php 
        $stream =  $selExamRow['stream']; 
        $selStream = $conn->query("SELECT stream FROM course_tbl WHERE cou_id='$courseId' ");
        while ($selStreamRow = $selStream->fetch(PDO::FETCH_ASSOC)) {
            echo $selStreamRow['stream'];
        }
    ?>
</td>
                                            <td><?php echo $selExamRow['ex_description']; ?></td>   
                                            <td><?php echo $selExamRow['ex_time_limit']; ?></td>
                                            <td><?php echo $selExamRow['ex_questlimit_display']; ?></td>
                                            <td class="text-center">
                                             <a href="manage-exam.php?id=<?php echo $selExamRow['ex_id']; ?>" type="button" class="btn btn-primary btn-sm">Manage</a>
                                             <button type="button" id="deleteExam" data-id='<?php echo $selExamRow['ex_id']; ?>'  class="btn btn-danger btn-sm">Delete</button>
                                            </td>
                                            <td>
                                                <?php
                                                if($selExamRow['status']==1){
                                                    echo '<span style="color:green";>activate</span>';
                                                    
                                                }
                                                if($selExamRow['status']==0){
                                                    echo '<span style="color:red";>deactivate</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                      
                                                <select style="background-color:yellow;" onchange="status_update(this.options[this.selectedIndex].value,'<?php echo $selExamRow['ex_id']?>')">
                                                    <option>select</option>
                                                    <option value="1,<?php echo $selExamRow['ex_id']?>">activate</option>
                                                    <option value="0,<?php echo $selExamRow['ex_id']?>">deactivate</option>
                                                </select>
                
                                            </td>
                                        </tr>

                                    <?php }
                                }
                                
                                else
                                { 
                                    ?>
                                    <tr>
                                      <td colspan="5">
                                        <h3 class="p-3">No Exam Found</h3>
                                      </td>
                                    </tr>
                                <?php 
                                }
                               ?>
               </tbody>
                            
            
                        </table>
                    </div>
                </div>
            </div>
      
        
</div>

</div>
<script type="text/javascript">
function status_update(value,ex_id){
//    alert(value,ex_id);   
     $.ajax({
          type:"POST",
          url: "pages/status.php",
          data: {status:value,id:ex_id},
          success: function(data)
          {   
            location.reload();
          }
        });
}
</script>   

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
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
