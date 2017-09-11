<?php
    session_start();
    if(!isset($_SESSION['uname']) || $_SESSION['role'] != 'S') {
        echo "ERROR IN SESSION"; 
        exit;
    }

    include_once(__DIR__."/../../includes/general.config.php");
?>

<html>
<head>
        <link rel="icon" href="./../../favicon.ico">
<title>eVerify Questions</title>
    <script src="libraries/RGraph.common.core.js"></script>
    <script src="libraries/RGraph.drawing.circle.js"></script>
    <script src="libraries/RGraph.drawing.text.js"></script>
    <script src="libraries/RGraph.common.dynamic.js"></script>
    <script src="libraries/RGraph.common.tooltips.js"></script>
    <script src="libraries/RGraph.common.key.js"></script>
    <script src="libraries/RGraph.pie.js"></script>
    
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="../../js/jquery-3.1.0.min.js" type="text/javascript"></script>
<link type="text/css" rel="stylesheet" href="../../css/materialize.min.css" media="screen,projection" />
</head>
<style>
        nav div a img.logo-img {
            height: 100%;
            padding: 4px;
            margin-left: 40px;
        }
        @media only screen and (max-width : 992px) {
            nav div a img.logo-img {
                margin-left: 0;
            }
        }
         .text {
            font-size: 1.2em;
        }
        
        .title {
            font-size: 1.8em;
        }
        #hidden {
            display: none;
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
            <div class="col s12 m8 offset-m2 l6 offset-l3 center">
                <p class="title">Choose a Question</p>
            </div>
        </div>
        <div class="row">
            <div class="col s12 center">
                <canvas id="graphCanvas" width="900" height="900"></canvas>
            </div>
        </div>
        
        <p id="hidden"><?php echo $_SESSION['course_name'] ?></p>
    </div>
<!-- BASIC SETUP (DO NOT CHANGE) -->
<script type="text/javascript" src="../../js/materialize.min.js"></script>
<script src="question.list.js" type="text/javascript"></script>
<!-- DONT CHANGE ABOVE IT -->
</body>
</html>
