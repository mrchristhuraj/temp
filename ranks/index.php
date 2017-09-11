<?php
    include_once(__DIR__."/../includes/sql.config.php");

    $sql = "SELECT * FROM `COURSE_TABLE`";
    $db = mysqli_query($link,$sql);
    if(!$db) 
          die("Failed to Insert: ".mysqli_error($link));


    include_once(__DIR__."/../includes/general.config.php");
?>

<html>

    <head>
        <link rel="icon" href="./../favicon.ico">
        <title>eVerify Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="../js/jquery-3.1.0.min.js" type="text/javascript"></script>
        <script src="home.js" type="text/javascript"></script>
        <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />
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

        #padd {
            padding-bottom: 10px;
        }
        .choice:hover {
            margin: 0;
            background-color: #FFF;
            cursor: pointer;
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
        }

    </style>

    <body>
        <nav>
            <div class="nav-wrapper red">
                <a href="<?php echo $HREF_URL  ?>"><img id="image" class="brand-logo logo-img s2" src="../logo.png"> </img></a>
                </a>
                <a href="#" class="brand-logo  center hide-on-med-and-down"><?php echo $NAVBAR_TEXT; ?></a>
                <ul id="nav-mobile" class="right">
                </ul>
            </div>
        </nav>

        <div class="container">
            <div class="card">
                <p id="top-bar" class="card-heading-main red white-text title">TOP CODERS*</p>
                <div class="card-content"> 
                    <div class="row">
                        <div class="col s12 m6">
                            <div class="input-field col s12">
                                <select id="courseSelection">
                                <?php
                                    if(mysqli_num_rows($db) > 0) {
                                        while($row = mysqli_fetch_assoc($db)){
                                            $temp2 =  $row['COURSE_NAME'];
                                            $temp1 = $row['COURSE_ID'];

                                            echo "<option value=\"".$temp1."\">".$temp2."</option>";
                                        }
                                    }
                                ?>
                                </select>
                                <label>Select Course</label>
                            </div>
                        </div>

                        <div class="col s12 m6">
                            <div class="input-field col s12">
                                <select id="levelSelection">
                                <option value="1">Level 1</option>;
                                <option value="2">Level 2</option>;
                                <option value="3">Level 3</option>;
                                </select>
                                <label>Select Level</label>
                            </div>
                        </div>

                        <div class="col s12 right-align">
                            <a id="reportBtn" class="btn pink">View Details</a>
                        </div>

                    </div>
                        <br>
                        <div id="tableDiv">

                        </div>
                        <div class="card-content"><div class="right red-text text-darken-3">* List contains names of student those who have completed all questions of particular level.</div></div>
                </div>
            </div>
        </div>
        <!-- BASIC SETUP (DO NOT CHANGE) -->
        <script type="text/javascript" src="../js/materialize.min.js"></script>
        <!-- DONT CHANGE ABOVE IT -->
    </body>
</html>
