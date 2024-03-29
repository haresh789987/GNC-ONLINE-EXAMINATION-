
<link rel="stylesheet" type="text/css" href="css/mycss.css">
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title"  style="background-color: lightslategrey; ">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div style='font-weight:bold;color:black;'>PRINT RESULT</div>
                    
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="main-card mb-3 card">
                 <div class="card-header text-center">Print Result</div>
<div class="card-body">
    <form method="POST" action="pages/print-details.php" class="text-center">
        <div class="row">
            <div class="col-md-2 mb-2">
                <?php
                $stmt = $conn->query("SELECT cou_id FROM course_tbl");
                $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo "<select name='co' class='form-control'>";
                echo "<option selected>course</option>";
                foreach ($rows as $row) {
                    echo "<option value='{$row['cou_id']}'>{$row['cou_id']}</option>";
                }
                echo "</select>";
                ?>
            </div>
             <div class="col-md-2 mb-2">
                <select name="yr" class="form-control">
                    <option value="">year</option>
                    <option value="first year">first year</option>
                    <option value="second year">second year</option>
                    <option value="third year">third year</option>
                </select>
   </div>
                        <div class="col-md-2 mb-2">
                <select name="sec" class="form-control">
                    <option value="">section</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                </select>
   </div>

                            <div class="row">
                    <div class="col-md-3">
                <button type="submit" class="btn btn-sm btn-primary" name="sel">
                    <i class="fa fa-file-pdf-o"></i> Print Details
                </button>
            </div>
        </div>
    </form>
</div>


                </div>
     
                 
                    </div>
 
</div>
