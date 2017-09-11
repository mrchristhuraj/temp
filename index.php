<?php
    session_start();
    $_SESSION['timeout'] = time();

    if(isset($_SESSION['uname'])) {
        unset($_SESSION['uname']);
    }

    include_once(__DIR__."/includes/general.config.php");

?>
    <html>

    <head>
        <link rel="icon" href="./favicon.ico">
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
        
        .form input {
            font-size: 1.2em;
            font-weight: 500;
        }
        
        .main-logo {
            margin-bottom: 50px;
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
        
        #button {
            display: inline-block;
        }
        
        #error {
            margin-top: 10px;
        }
        
        .foot-text, .foot-text a {
            padding: 10px;
            text-transform: uppercase;
            color: #757575;
        }
        #about {
            clear: both;
            cursor: pointer;
        }
        .aboutDiv {
            clear: both;
            margin: 12px 0 11px 0;
            text-alignment: center;
        }
        .text {
            padding-top: 115px;
            font-size: 1.2em;
        }
        .side-nav .userView a {
            padding: 3px;
        }
        .side-nav a {
            font-weight: 400;
            cursor: pointer;
        }
        .row {
            margin-bottom: 0px;
        }
	.space-top {
	    margin-top: 13px;
	}

        #modal-footer-msg {
		font-size: 13px;
        }
	#modal-content-msg {
		font-size: 17px;
	}
    #medal {
        margin-left: 25px;
    }
    #ranks {
        font-size: 17px;
    }
        
    }
    </style>

    <body>
        <nav>
            <div class="nav-wrapper  red">
                <a href="<?php echo $HREF_URL; ?>"><img id="image" class="brand-logo logo-img s2" src="logo.png"> </img></a>
                <a href="#" class="brand-logo  center hide-on-med-and-down"><?php echo $NAVBAR_TEXT; ?></a>
            </div>
        </nav>


   <div id="modal1" class="modal">
    <div class="modal-content">
      <h4 class="center-align"> SRM University eVerify</h4>

      <p class="space-top" id="modal-content-msg">eVerify is an auto evaluation tool for laboratory programming examinations. eVerify helps students to verify their programming skills.</p><br>
      <div class="left">
      </div>
      <p class="space-top red-text text-darken-3 right-align" id="modal-footer-msg">* For any Queries Contact Your Respective Faculty</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close waves-effect waves-blue btn-flat">CLOSE</a>
    </div>
  </div>

        <div class="container">
            <div class="row">
            <div class="col s12 l4 offset-l4 m10 offset-m1">
            <div class="card">
                <div class="login red white-text">eVerify SIGN IN</div>
                <div class="card-content">
                    <div class="form ">
                        <!-- <img class="main-logo responsive-img" src="logo-2.png" /> -->
                        <div class="form">
                        <div class="row">
                            <div class="col s12 input-field">
                                <!-- Username --><input id="username" type="text" name="username" class="validate">
                                <label for="username">Registration Number/Employee ID</label>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col s12 input-field">
                                <!-- Password --><input id="password" type="password" name="password" class="validate">
                                <label for="password">Password</label>
                                </div>
                                <div class="center  red-text text-darken-2" id="error">
                                    <p id="error"></p>
                                </div>
                                <div class="progress pink lighten-3">
                                    <div class="indeterminate pink darken-1"></div>
                                </div>
                                <script>
                                    $(".progress").hide();
                                </script>
                                <a class="waves-effect waves-light btn pink right pulse" id="button"><b>Login</b></a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="seperator "></div>
                <!-- ORIGNAL CODE 
                <div class="aboutDiv center">

                                <a class="foot-text grey-text text-darken-3 center-text" data-activates="slide-out" id="about">ABOUT eLAB</a>
                </div>

                
                <div class="seperator "></div>
-->             <div class="center foot-text">
                        <a class="forgot foot-text" id="about">About eVerify</a>
                </div>
                <div class="seperator "></div>

                <div class="center foot-text">
                        <a href="facultyregister/index.php" class="forgot " id="about">Faculty Registration</a>
                </div>
                <div class="seperator "></div>

              <!--  <div class="center foot-text">
                        <a href="register/register.php">Student Registration</a>
                </div>
                <div class="seperator "></div> -->

                <!--ORIGNAL CODE <a href="register/forgot_password.php" class="forgot left foot-text">Forgot Password ?</a> -->
                
                
                
                <div class="seperator "></div>
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
