<?php
    session_start();
    if(!isset($_SESSION['uname']) || $_SESSION['role'] != 'F') {
        echo "ERROR IN SESSION"; 
        exit;
    }
    $staffID = $_SESSION['uname'];
    $name = $_SESSION['name'];
    $TABLE_NAME = "faculty_".$staffID;
    
    include_once(__DIR__."/../../includes/sql.config.php");
    include_once(__DIR__."/../../includes/general.config.php");
?>

<html>
<head>
<title>eVerify Remove Students</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../../css/materialize.min.css" type="text/css" /> 
<script src="../../js/jquery-3.1.0.min.js" type="text/javascript"></script>
<script src="delete.js" type="text/javascript"></script>
</head>
<style>
    .srm-text {
            margin-left: 30px;
        }
        
        nav div a img.logo-img {
            height: 100%;
            padding: 4px;
            margin-left: 40px;
        }
        .login {
            padding: 20px;
            font-size: 1.3em;
        }
         .text {
            font-size: 1.2em;
        }
        
        .title {
            font-size: 1.8em;            
        }
        .caps {
            text-transform: uppercase;
        }
        .small-container {
            margin-right: 50px;
            margin-left: 50px;
        }
</style>
<body>
    <nav>
            <div class="nav-wrapper red">
                <a href="<?php echo $HREF_URL  ?>"><img id="image" class="brand-logo logo-img s2" src="../../logo.png"> </img></a>
                </a>
                <a href="#" class="brand-logo  center hide-on-med-and-down"><?php echo $NAVBAR_TEXT; ?></a>
                <ul id="nav-mobile" class="right">
                    <li><a href="../../index.php">Logout</a></li>
                    <li><a href="home.php">Home</a></li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="card">
                <div class="login red caps white-text">Faculty</div>
                    
                <div class="card-content text"><p>Name: <a class="black-text">
                    <?php
                        echo $name;
                    ?>
                    </a></p>
                    <p>Faculty ID: <a class="black-text">
                    <?php
                        echo $staffID;
                    ?>
                    </a></p>
                </div>
            </div>
            </div>
        </div>


            <div class="row small-container">
                <div class="card">
                <div class="login red caps white-text">Remove Students</div>
                    
                <div class="card-content text">
                <a class="black-text">
                <table class="bordered highlight">
                    <thead>
                    <tr>
                        <td><b>Student Reg. No</b></td>
                        <td><b>Student Name</b></td> 
                            <td><b>Registered Course</b></td>
                        <td><b>Action</b></td>
                    </tr> 
                    </thead>
                    <tbody id="tBody">
                    <?php
                        $sql = " SELECT * FROM $TABLE_NAME";
                        $db = mysqli_query($link,$sql);
                        if(!$db) 
                            die("Failed to Insert: ".mysqli_error($link));
                        if(mysqli_num_rows($db) > 0) {
                            while($row = mysqli_fetch_assoc($db)) {
                                echo "<tr><td>";
                                echo $row['STUD_ID'];
                                echo "</td><td>";
                                echo $row['STUD_NAME'];
                                echo "</td><td>";
                                echo $row['COURSE_NAME'];
                                echo "</td><td>";
                                echo "<div class=\"options\">
                                        <button class=\"falseBtn btn waves-effect pink waves-light\" type=\"submit\" name=\"action\">Delete Student</button>";
                                
                                echo '</tr>';
                            }
                        }    
                        ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>

    

    <!-- BASIC SETUP (DO NOT CHANGE) -->
        <script type="text/javascript" src="../../js/materialize.min.js"></script>
        <!-- DONT CHANGE ABOVE IT -->
</body>

  </html>  
