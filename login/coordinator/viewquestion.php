<?php
    session_start();
    if(!isset($_SESSION['uname']) || $_SESSION['role'] != 'C') {
        echo "ERROR IN SESSION"; 
        exit;
    }

    $username = $_SESSION['uname'];
    $name = $_SESSION['name'];
    $course_name = $_SESSION['course_name'];
    
    
    include_once(__DIR__."/../../includes/sql.config.php");
    include_once(__DIR__."/../../includes/general.config.php");
    $TABLE_NAME = $course_name."_QUESTION_TABLE";
    $sql = "SELECT `Q_ID`,`S_NAME`,`Q_NAME` FROM `$TABLE_NAME`";

    $db = mysqli_query($link,$sql);
        if(!$db) 
            die("Failed to Insert: ".mysqli_error($link));       
?>

    <html>

    <head>
        <title>eVerify Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="../../js/jquery-3.1.0.min.js" type="text/javascript"></script>
        <script src="home.js" type="text/javascript"></script>
        <link type="text/css" rel="stylesheet" href="../../css/materialize.min.css" media="screen,projection" />
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
        
        .card-heading-main {
            padding: 20px;
            font-weight: 300;
            margin-bottom: 15px;
        }
        
         .text {
            font-size: 1.2em;
        }
        
        .title {
            font-size: 1.8em;            
        }
        @media only screen and (max-width : 992px) {
            nav div a img.logo-img {
                margin-left: 0;
            }
        }
        .card-panel:hover {
            margin: 0;
            background-color: #FFF;
            cursor: pointer;
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
        }
        .dropdown-regid {
            width: 100%;
        }
        .resultDiv {
            padding: 15px;
            font-size: 3em;
        }
        .clear {
            clear: both;
        }
        .caps{

            text-transform: uppercase;
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
            <div class="card">
                <p id="top-bar" class="card-heading-main caps red white-text title"><?php echo $course_name." " ?> Questions</p>
                <div class="card-content">
                    <p class="caps title">Available Questions</p>
                    <br>
                    <div class="row">
                        <div class="col s12 tableDiv">
                            <?php
                                    echo "<table id=\"table_display_data\" class=\"bordered centered highlight\"><thead><tr><th>Question ID</th><th>Question Name</th><th>Session Name</th></tr></thead><tbody>";
                                    if(mysqli_num_rows($db) > 0) {
                                        if(mysqli_query($link,$sql)) {
                                            while($row = mysqli_fetch_assoc($db)) {
                                                echo "<tr>";
                                                echo "<td>".$row['Q_ID']."</td>";
                                                echo "<td>".$row['Q_NAME']."</td>";
                                                echo "<td>".$row['S_NAME']."</td>";
                                                echo "</tr>";
                                            }
                                        }
                                    }
                                    echo "</tbody><table>";

                            ?>
                        </div>
                    </div>
                    <div>
                       <br><br> <div class="right-align col s12">
                                <a id="getReportBtn" class="waves-effect pink waves-light btn">Export Questions</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <script>

$('#getReportBtn').click(function(){
        var f = $("<form target='_blank' method='POST' style='display:none;'></form>").attr({
                action: '../export.data.php'
            }).appendTo(document.body);
        $('<input type="hidden" />').attr({
            name: 'html_data',
            value: $('.tableDiv').html()
        }).appendTo(f);

    f.submit();
    f.remove();
    });
        </script>


 


        <!-- BASIC SETUP (DO NOT CHANGE) -->
        <script type="text/javascript" src="../../js/materialize.min.js"></script>
        <!-- DONT CHANGE ABOVE IT -->
    </body>

    </html>
