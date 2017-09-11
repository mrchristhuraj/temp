<?php
    session_start();
    if(!isset($_SESSION['uname']) || $_SESSION['role'] != 'A') {
        echo "ERROR IN SESSION";
        exit;
    }


    include_once(__DIR__."/../../includes/general.config.php");

?>

<html>
<head>
<title>eVerify Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../../css/materialize.min.css" type="text/css" /> 
<script src="../../js/jquery-3.1.0.min.js" type="text/javascript"></script>
        <link href="./../../css/material-icons.css" rel="stylesheet">
<script src="modify.js" type="text/javascript"></script>
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
                <div class="login red caps white-text">Change Student/ Faculty Password</div>  
                <div class="card-content text">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <div class="row">
                            <div class="col s12 input-field">
                                <i class="material-icons prefix">assignment_ind</i>
                                <input id="username" type="text" name="username" class="validate">
                                <label for="username">Student ID / Employee ID</label>
                            </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <div class="row">
                            <div class="col s12 input-field">
                                <i class="material-icons prefix">vpn_key</i>
                                <input id="password" type="password" name="username" class="validate">
                                <label for="password">Password</label>
                            </div>
                            </div>
                        </div>
                        <div class="col s12 m6 l6">
                            <div class="row">
                            <div class="col s12 input-field">
                                <i class="material-icons prefix">vpn_key</i>
                                <input id="passwordRetype" type="password" name="username" class="validate">
                                <label for="passwordRetype">Confirm Password</label>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 right-align">
                            <a class="btn pink" id="changePasswordButton">Submit</a>
                        </div>
                    </div>
                    
                </div>
            </div>
            </div>
        </div> 

    <!-- BASIC SETUP (DO NOT CHANGE) -->
        <script type="text/javascript" src="../../js/materialize.min.js"></script>
        <!-- DONT CHANGE ABOVE IT -->
</body>

  </html>  
