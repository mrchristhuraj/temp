<?php
    session_start();

    include_once(__DIR__."/../../includes/general.config.php");
?>

<html>
<head>
<title>eVerify Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="../../js/jquery-3.1.0.min.js" type="text/javascript"></script>
        <link type="text/css" rel="stylesheet" href="../../css/materialize.min.css" media="screen,projection" />

<script src="login.admin.elab.js" type="text/javascript"></script>
<link rel="stylesheet" href="login.admin.elab.css" type="text/css" />
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
            font-weight: 400;
            text-transform: uppercase;
        }

        .title {
            font-size: 1.5em;
            text-transform: uppercase;
        }

        .title2 {
            font-size: 1.8em;
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
        .resultDiv,.textBox {
            padding: 15px;
            font-size: 3em;
        }
        .switch label input[type=checkbox]:checked+.lever:after {
            background-color: #FFF;
        }
        .switch {
          padding-left: 12px;
        }
        #sqlConsole {
            clear: both;
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
            <p id="top-bar" class="card-heading-main red white-text title">Admin Actions</p>
            <div class="card-content">
                <p class="title2">EXECUTE SQL COMMAND</p>
                <br>
                <div class="row">
                    <form class="col s12">
                        <div class="row">
                            <div class="input-field col s12">
                            <textarea id="textarea1" class="materialize-textarea"></textarea>
                            <label for="textarea1">SQL Command</label>
                            </div>
                        </div>
                        <div class="right">
                            <a class="btn pink" id="sqlExecute">Execute</a>
                        </div>  
                        <div id="sqlConsole">
                            
                        </div>
                    </form>
                </div>
            </div>
        <div>
    </div>
    
          
        
        <script type="text/javascript" src="../../js/materialize.min.js"></script>
</body>

</html> 
                
