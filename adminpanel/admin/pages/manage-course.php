<link rel="stylesheet" type="text/css" href="css/mycss.css">
<div class="app-main__outer" >
        <div class="app-main__inner">
            <div class="app-page-title" style="background-color: lightslategrey; ">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div style='font-weight:bold;color:black;'>MANAGE COURSE</div>
                    </div>
                </div>
            </div>        
            
          <div class="col-md-12">
    <div class="main-card mb-3 card">
        <div class="card-header">Course List
            <div class="search-bar">
                 <i class="fa fa-search search-icon"></i>
                <input type="text" id="search" placeholder="Enter Course Name..." oninput="searchByName()">
            </div>
        </div>
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
                                <th class="text-left pl-4">Course Id</th>
                                <th class="text-left pl-4">Course Name</th>
                                 <th class="text-left pl-4">Stream</th>
                                <th class="text-center" width="20%">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                              <?php 
                                $selCourse = $conn->query("SELECT * FROM course_tbl ORDER BY cou_id DESC ");
                                if($selCourse->rowCount() > 0)
                                {
                                    while ($selCourseRow = $selCourse->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <tr>
                                              <td class="pl-4">
                                                <?php echo $selCourseRow['cou_id']; ?>
                                            </td>
                                            <td class="pl-4">
                                                <?php echo $selCourseRow['cou_name']; ?>
                                            </td>
                                               <td class="pl-4">
                                                <?php echo $selCourseRow['stream']; ?>
                                            </td>
                                            <td class="text-center">
                                                <a rel="facebox" style="text-decoration: none;" class="btn btn-primary btn-sm" href="facebox_modal/updateCourse.php?id=<?php echo $selCourseRow['cou_id']; ?>" id="updateCourse">Update</a>
                                             <button type="button" id="deleteCourse" data-id='<?php echo $selCourseRow['cou_id']; ?>'  class="btn btn-danger btn-sm">Delete</button>
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