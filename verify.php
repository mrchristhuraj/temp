<?php
    session_start();
    $_SESSION['timeout'] = time();

    if(isset($_SESSION['uname'])) {
        unset($_SESSION['uname']);
    }

    $req_id = $_REQUEST['q'];
    $req_no = $_REQUEST['u'];

    include_once(__DIR__."/includes/sql.config.php");
?>
    <html>

    <head>
        <title>SRM eVerify Login</title>
        <!-- BASIC SETUP (DO NOT CHANGE) -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="js/jquery-3.1.0.min.js"></script>
        <script src="index.elab.js" type="text/javascript"></script>
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
        <!-- DONT CHANGE ABOVE IT -->
    </head>
    <style>
        .container {
            margin-top: 80px;
        }        
        nav div a img.logo-img {
            height: 100%;
            padding: 4px;
            margin-left: 40px;
        }        
        .login {
            padding: 20px;
            font-size: 1.3em;
            margin-bottom: 15px;
        }
       
        .seperator {
            width: 100%;
            border-bottom: 1px solid;
            border-color: #cfd8dc;
            clear: both;
        }
        
        #error {
            margin-top: 10px;
        }
        
        .foot-text {
            padding: 14px;
            text-transform: uppercase;
            color: #757575;
        }
    }
    </style>

    <body>
        <nav>
            <div class="nav-wrapper  indigo darken-4">
                <a href="<?php echo $HREF_URL  ?>"><img id="image" class="brand-logo logo-img s2" src="logo.png"> </img></a>
                <a href="#" class="brand-logo  center hide-on-med-and-down">SRM UNIVERSITY eLab</a>
            </div>
        </nav>

        <div class="container">
            <div class="row">
            <div class="col s12 l6 offset-l3 m10 offset-m1">
            <div class="card">
                <div class="login red white-text">REGISTRATION CONFIRMATION</div>
                <div class="card-content">

              <div class="form">
                            <div class="row">
                                <div class="center  red-text text-darken-2" id="error">
                                    <p id="error">REGISTRATION SUCCESSFUL</p>
                                </div>
                            </div>
                        </div>

                        



                </div>
                <div class="seperator "></div>
                <a href="index.php" class="forgot left foot-text">Login</a>

                <a class="right foot-text" href="register/register.php">Register</a>
                <div style="clear: both"></div>
            </div>


            </div>
            </div>
        </div>

        <!-- BASIC SETUP (DO NOT CHANGE) -->
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <!-- DONT CHANGE ABOVE IT -->
    </body>
    </html>