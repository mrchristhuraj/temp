<?php
    session_start();
    $_SESSION['timeout'] = time();
    if(isset($_SESSION['uname'])) {
        unset($_SESSION['uname']);
    }


    include_once(__DIR__."/../includes/general.config.php");
    include_once(__DIR__."/../includes/sql.config.php");

    $sql = "SELECT * FROM `flags`";
      $db = mysqli_query($link,$sql);
      if(!$db)
            die("Failed to Insert: ".mysqli_error($link));
      $row = null;
      if(mysqli_num_rows($db) > 0 ){
        while ($row = mysqli_fetch_assoc($db)) {
            if($row['NAME'] == 'STUDENT_REGISTER') {
              if($row['VALUE'] == 0) {
                  readfile("./registartion-closed.html");
                  exit;
              }
            }
          }
     }

// id 0 then, cannot register
// if 1 the, can register

?>
    <html>

    <head>
        <title>SRM eVerify Register</title>
        <!-- BASIC SETUP (DO NOT CHANGE) -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="../js/jquery-3.1.0.min.js"></script>
        <script src="register.js" type="text/javascript"></script>
        <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />
        <link href="material-icons.css" rel="stylesheet">
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
        .main-logo {
            margin-bottom: 50px;
        }
        .login {
            padding: 20px;
            font-size: 1.3em;
            margin-bottom: 15px;
        }
        #error {
            margin-top: 10px;
        }
        @media only screen and (max-width : 992px) {
            nav div a img.logo-img {
                margin-left: 0;
            }
        }
        .dropdown-content li>a, .dropdown-content li>span {
            color: #1a237e;
        }
        .picker__date-display{
            background-color: #3949ab;
        }
        .picker__weekday-display {
            background-color: #283593;
        }
        .picker__day--selected, .picker__day--selected:hover, .picker--focused .picker__day--selected {
            background-color: #3949ab;
        }
        .picker__close, .picker__today {
            color: #d81b60;
        }
    </style>

    <body>
        <nav>
            <div class="nav-wrapper  red">
                <a href="<?php echo $HREF_URL  ?>"><img id="image" class="brand-logo logo-img s2" src="../logo.png"> </img></a>
                <a href="#" class="brand-logo  center hide-on-med-and-down"><?php echo $NAVBAR_TEXT; ?></a>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col s12 l10 offset-l1 m12 ">
                    <div class="card">
                    <div class="login red white-text">STUDENT REGISTRATION</div>
                        <div class="card-content">

                            <!-- Username -->
                            <div class="row">
                                <div class="col s12 m6 l6">
                                    <div class="row">
                                    <div class="col s12 input-field">
                                        <i class="material-icons prefix">assignment_ind</i>
                                        <input id="username" type="text" name="username" class="validate">
                                        <label for="username">Registration Number</label>
                                    </div>
                                    </div>
                                </div>

                                <div class="col s12 m6 l6">
                                    <div class="row input-field">
                                        <div clas="col s12 input-field">
                                            <select id="departmentList">
                                            <option value="" disabled selected>Choose your option</option>
                                                <option value="1"> Computer Science and Eng. </option>
                                                <option value="2"> Information Technology </option>
                                                <option value="3"> Software Engineering </option>
                                                <option value="4"> Civil Engineering </option>
                                                <option value="5"> Mechanical engineering </option>
                                                <option value="6"> Automobile Engineering </option>
                                                <option value="7"> Aerospace Engineering </option>
                                                <option value="8"> Mechatronics </option>
                                                <option value="9">  Electronics and Comm. </option>
                                                <option value="10"> Telecommunication </option>
                                                <option value="11"> Electrical & Electronics </option>
                                                <option value="12"> Electronics and Instru. </option>
                                                <option value="13"> Instru. & Ctrl Eng </option>
                                                <option value="14"> Chemical Engineering </option>
                                                <option value="15"> Biotechnology </option>
                                                <option value="16"> Biomedical Engineering </option>
                                                <option value="17"> Genetic Engineering </option>
                                                <option value="18"> Food Process Engineering </option>
                                                <option value="19"> Nanotechnology </option>
                                                <option value="20"> Nuclear Engineering </option>
                                            </select>
                                            <label>Department</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- Username -->
                            
                            <!-- Password -->                            
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
                            <!-- Password -->    


                            <!-- Name -->                            
                            <div class="row">
                                <div class="col s12 m6 l6">
                                    <div class="row">
                                    <div class="col s12 input-field">
                                        <i class="material-icons prefix">perm_identity</i>
                                        <input id="firstName" type="text" name="username" class="validate">
                                        <label for="firstName">First Name</label>
                                    </div>
                                    </div>
                                </div>
                                <div class="col s12 m6 l6">
                                    <div class="row">
                                    <div class="col s12 input-field">
                                        <i class="material-icons prefix">perm_identity</i>
                                        <input value="Student" id="lastName" type="text" name="username" disabled="disabled">
                                        <label for="lastName">Last Name</label>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Name -->   

                            <!-- Email -->    
                            <div class="row">
                                <div class="col s12 m8 l8">
                                    <div class="row">
                                    <div class="col s12 input-field">
                                        <i class="material-icons prefix">email</i>
                                        <input id="email" value="sample4@mail.com" type="text" name="username" disabled="disabled" class="validate">
                                        <label for="email">Email</label>
                                    </div>
                                    </div>
                                </div> 
                                <div class="col s12 m4 l4">
                                    
                                        <label for="dob">Date of Birth</label>
                                        <input value="2017-03-08"  id="dob" type="date" name="username" disabled="disabled" class="datepicker">

                                    
                                </div>
                            </div>
                            <!-- Email -->    


                            <!-- Mobile -->
                            <div class="row">
                                <div class="col s10 m8 l6">
                                    <div class="row">
                                    <div class="col s12 input-field">
                                        <i class="material-icons prefix">dialpad</i>
               <input value="1234567890" disabled="disabled" id="mobilenumber" type="tel" name="username" class="validate">
                                        <label for="mobilenumber">Mobile Number</label>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <!-- Moblie --> 
                            <div class="row center red-text text-darken-2 flow-text">
                                <p id ="errorMsg">Error Message Will Come Here...</p>
                            </div>
                            <div class="row center">
                                    <a class="waves-effect waves-light btn-flat pink white-text" id="button"><b>Register as student</b></a>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- BASIC SETUP (DO NOT CHANGE) -->
        <script type="text/javascript" src="../js/materialize.min.js"></script>
        <!-- DONT CHANGE ABOVE IT -->
    </body>
    </html>
