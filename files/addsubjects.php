<!DOCTYPE html>

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>TimeTable Management System</title>
    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet"/>
    <!-- FONT AWESOME CSS -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet"/>
    <!-- FLEXSLIDER CSS -->
    <link href="assets/css/flexslider.css" rel="stylesheet"/>
    <!-- CUSTOM STYLE CSS -->
    <link href="assets/css/style.css" rel="stylesheet"/>
    <!-- Google	Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'/>
</head>
<body>

<div class="navbar navbar-inverse navbar-fixed-top " style = "background-color: darkred;" id="menu">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>
        <div class="navbar-collapse collapse move-me">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="index.html">HOME</a></li>
                <li><a href="timetable.html">TIMETABLES</a></li>
                <li><a href="addteachers.php">TEACHERS</a></li>
                <li><a href="addrooms.php">ROOMS</a></li>
                <li><a href="addsubjects.php">SUBJECTS</a></li>
                
            </ul>
            <!-- <ul class="nav navbar-nav navbar-right">
                <li><a href="index1.html">LOGOUT</a></li>
            </ul> -->

        </div>
    </div>
</div>
<!--NAVBAR SECTION END-->
<br>

<div align="center" style="margin-top:60px">
    <form name="import" method="post" enctype="multipart/form-data">
       <input style = "margin-left: 80px;" type="file" name="file"/>
        <input type="submit" name="subjectexcel" id="subjectexcel"   style = "
    color: #fff;
    background: rgb(252,69,97); background: linear-gradient(90deg, rgba(252,69,97,1) 23%, rgba(253,29,29,1) 50%);" class="btn btn-info btn-lg" value="IMPORT EXCEL"/>
    </form>
    <?php
    if (isset($_POST['subjectexcel'])) {
        if (empty($_FILES['file']['tmp_name'])) {
            echo '<script>alert("Select a file first! ");</script>';
        } else {
            $file = $_FILES['file']['tmp_name'];
            $handle = fopen($file, 'r');
            while (!feof($handle)) {
                $filesop = fgetcsv($handle, 1000);
                $code = $filesop[0];
                $name = $filesop[1];
                $type = $filesop[2];
                $semester = $filesop[3];
                $shift = $filesop[4];
                $department = $filesop[5];
                if ($code == "" || $code == "Subject Code") {
                    continue;
                }
                $q = mysqli_query(mysqli_connect("localhost", "root", "", "tt",'3307'),
                    "INSERT INTO subjects VALUES ('$code','$name','$type','$semester','$shift','$department')");
            }
        }
    }
    ?>
</div>
<div align="center" style="margin-top: 20px">

    <button id="subjectmanual" style = "
    color: #fff;
    background: linear-gradient(to bottom, #990000 0%, #ff0066 100%);" class="btn btn-success btn-lg">ADD SUBJECT</button>
</div>

<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header" style="margin-top: -60px ; background-color: #990000 ;">
            <span class="close">&times</span>
            <h2 id="popupHead">Add Subject</h2>
        </div>
        <div class="modal-body" id="EnterSubject">
            <!--Admin Login Form-->
            <div style="display:block ; margin-bottom: 28px;" id="addSubjectForm">
                <form action="addsubjectFormValidation.php" method="POST">
                    <div class="form-group">
                        <label for="subjectname">Subject Name</label>
                        <input type="text" style=" padding: 6px 12px; margin-bottom: -21px;" class="form-control" id="subjectname" name="SN"
                               placeholder="Subject's Name ...">
                    </div>
                    <div class="form-group">
                        <label for="subjectcode">Subject Code</label>
                        <input type="text"  style=" padding: 6px 12px; margin-bottom: -21px;" class="form-control" id="subjectcode" name="SC" placeholder="CO203 CO205...">
                    </div>
                    <div class="form-group">
                        <label for="subjecttype">Course Type</label>
                        <select style=" padding: 6px 12px; margin-bottom: -21px;" class="form-control" id="subjecttype" name="ST">
                            <option selected disabled>Select</option>
                            <option value="THEORY">THEORY</option>
                            <option value="LAB">LAB</option>

                        </select>

                    </div>
                    <div class="form-group">
                        <label for="subjectsemester">Semester</label>
                        <select style=" padding: 6px 12px; margin-bottom: -21px;" class="form-control" id="subjectsemester" name="SS">
                            <option selected disabled>Select</option>
                            <option value="3">1</option>
                            <option value="4">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subjectshift">Shift</label>
                        <select style=" padding: 6px 12px; margin-bottom: -21px;" class="form-control" id="subjectshift" name="SF">
                            <option selected disabled>Select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                
                    <div class="form-group">
                        <label for="subjectdepartment">Department</label>
                        <select style=" padding: 6px 12px; margin-bottom: -21px;" class="form-control" id="subjectdepartment" name="SD">
                            <option selected disabled>Select</option>
                            <option value="Computer Engg.">Computer Engg.</option>
                            <option value="Electronics Engg.">Electronics Engg.</option>
                            <option value="Electrical Engg.">Electrical Engg.</option>
                            <option value="Mechanical Engg.">Mechanical Engg.</option>
                        </select>
                    </div>
                    <div align="right" class="form-group">
                        <input type="submit" style=" padding: 8px 20px; margin-bottom: -21px; padding: 5px 40px;
    margin-bottom: -20px; background-color: #990000 ; color:white;" class="btn btn-default" name="ADD" value="ADD">
                    </div>
                </form>
            </div>
        </div>
        <!-- <div class="modal-footer">
        </div> -->
    </div>
</div>

<script>
    // Get the modal
    var modal = document.getElementById('myModal');

    // Get the button that opens the modal
    var addsubjectBtn = document.getElementById("subjectmanual");
    var heading = document.getElementById("popupHead");
    var subjectForm = document.getElementById("addSubjectForm");
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal

    addsubjectBtn.onclick = function () {
        modal.style.display = "block";
        //heading.innerHTML = "Faculty Login";
        subjectForm.style.display = "block";
        //adminForm.style.display = "none";


    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
        //adminForm.style.display = "none";
        subjectForm.style.display = "none";

    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>


<div>
    <br>
    <style>
        table {
            margin-top: 10px;
            font-family: arial, sans-serif;
            border-collapse: collapse;
            margin-left: 50px;
            width: 90%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>

    <script>
        function deleteHandlers() {
            var table = document.getElementById("subjectstable");
            var rows = table.getElementsByTagName("tr");
            for (i = 0; i < rows.length; i++) {
                var currentRow = table.rows[i];
                //var b = currentRow.getElementsByTagName("td")[0];
                var createDeleteHandler =
                    function (row) {
                        return function () {
                            var cell = row.getElementsByTagName("td")[0];
                            var id = cell.innerHTML;
                            var x;
                            if (confirm("Are You Sure?") == true) {
                                window.location.href = "deletesubject.php?name=" + id;

                            }

                        };
                    };

                currentRow.cells[6].onclick = createDeleteHandler(currentRow);
            }
        }
    </script>
    
    <table id=subjectstable style="margin-left: 90px">
        <caption><b>SAVED SUBJECT'S INFORMATION<b></caption><br>
        <tr>
            <th width="150">Code</th>
            <th width=300>Subject</th>
            <th width=150>Course Type</th>
            <th width="150">Semester</th>
            <th width="150">Shift</th>
            <th width="350">Department</th>
            <th width="40">Action</th>
        </tr>
        <?php
        include 'connection.php';
        $q = mysqli_query(mysqli_connect("localhost", "root", "", "tt",'3307'),
            "SELECT * FROM subjects ORDER BY subject_code ASC ");
        while ($row = mysqli_fetch_assoc($q)) {
            echo "<tr><td>{$row['subject_code']}</td>
                    <td>{$row['subject_name']}</td>
                    <td>{$row['course_type']}</td>
                    <td>{$row['semester']}</td>
                    <td>{$row['shift']}</td>
                     <td>{$row['department']}</td>
                     <td><button>Delete</button></td>
                    </tr>\n";
        }
        echo "<script>deleteHandlers();</script>";
        ?>
    </table>
    
</div>
<!--HOME SECTION END-->



<!--  Jquery Core Script -->
<script src="assets/js/jquery-1.10.2.js"></script>
<!--  Core Bootstrap Script -->
<script src="assets/js/bootstrap.js"></script>
<!--  Flexslider Scripts -->
<script src="assets/js/jquery.flexslider.js"></script>
<!--  Scrolling Reveal Script -->
<script src="assets/js/scrollReveal.js"></script>
<!--  Scroll Scripts -->
<script src="assets/js/jquery.easing.min.js"></script>
<!--  Custom Scripts -->
<script src="assets/js/custom.js"></script>
</body>
</html>
