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

<div class="navbar navbar-inverse navbar-fixed-top " style = "background-color: darkred ;" id="menu">
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

<div align="center"
     style="margin-top:10%">
    <button
        id="classroommanual" style = "
    color: #fff;
    background: linear-gradient(to bottom, #990000 0%, #ff0066 100%);"  class="btn btn-success btn-lg">ADD CLASSROOM
    </button>
</div>

<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header" style="margin-top: -60px ; background-color: #990000 ;">
            <span class="close">&times</span>
            <h2 id="popupHead">Add Classroom</h2>
        </div>
        <div class="modal-body" id="EnterClassroom">
            <!--Admin Login Form-->
            <div style="display:block ; margin-bottom: 28px;" id="addClassroomForm">
                <form action="addroomFormValidation.php" method="POST">
                    <div class="form-group">
                        <label for="classroomno">Classroom No.</label>
                        <input type="text" style=" padding: 6px 12px; margin-bottom: -21px;" class="form-control" id="classroomno" name="RN"
                               placeholder="12,24,30...">
                    </div>
                    <div class="form-group">
                        <label for="classroomdiv">Div</label>
                        <input type="text" style=" padding: 6px 12px; margin-bottom: -21px;" class="form-control" id="classroomno" name="RD"
                               placeholder="A,B...">
                    </div>
                    <div class="form-group">
                        <label for="shift">Shift</label>
                        <select style=" padding: 6px 12px; margin-bottom: -21px;" class="form-control" id="shift" name="RS">
                            <option selected disabled>Select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                    <div align="right">
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
    var addclassroomBtn = document.getElementById("classroommanual");
    var heading = document.getElementById("popupHead");
    var classroomForm = document.getElementById("addClassroomForm");
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal

    addclassroomBtn.onclick = function () {
        modal.style.display = "block";
        //heading.innerHTML = "Faculty Login";
        classroomForm.style.display = "block";
        //adminForm.style.display = "none";


    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
        //adminForm.style.display = "none";
        classroomForm.style.display = "none";

    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

<script>
    function deleteHandlers() {
        var table = document.getElementById("classroomstable");
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
                            window.location.href = "deleteroom.php?name=" + id;

                        }

                    };
                };
            currentRow.cells[3].onclick = createDeleteHandler(currentRow);
        }
    }
</script>

<div align="center">
    <br>
    <style>
        table {
            margin-top: 10px;
            font-family: arial, sans-serif;
            border-collapse: collapse;
            margin-left: 50px;
            width: 70%;
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


    <table id=classroomstable>
        <caption><strong>SAVED CLASSROOMS IN THE SCHEDULER</strong></caption>
        <tr>
            <th width="100">Classroom No.</th>
            <th width="100">Division</th>
            <th width="100">Shift</th>
            <th width="80">Action</th>
        </tr>
        <?php
        include 'connection.php';
        $q = mysqli_query(mysqli_connect("localhost", "root", "", "tt",'3307'),
            "SELECT * FROM rooms ORDER BY room_no ASC  ");
        while ($row = mysqli_fetch_assoc($q)) {
            
            echo "<tr><td>{$row['room_no']}</td>
                    <td>{$row['division']}</td>
                    <td>{$row['shift']}</td>
                    <td><button>Delete</button></td>
                    </tr>\n";
        }
        echo "<script>deleteHandlers();</script>";
        ?>
    </table>
</div>
<!--HOME SECTION END-->

<!--<div id="footer">
    <!--  &copy 2014 yourdomain.com | All Rights Reserved |  <a href="http://binarytheme.com" style="color: #fff" target="_blank">Design by : binarytheme.com</a>
--></div>
<!-- FOOTER SECTION END-->

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

