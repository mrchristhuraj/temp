<html>
    <head><title>Exporting...</title></head>
<style>
    #table_display_data {
        display: none;
    }

</style>
    <body>


    <?php echo $_REQUEST['html_data']; ?>

        <script src="../js/jquery-3.1.0.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../css/materialize.min.css" type="text/css" />
        <script type="text/javascript" src="../js/FileSaver.js"></script>
        <script type="text/javascript" src="../js/tableexport.js"></script>
<br><br><br><br><br><br><div class="center"><div class="preloader-wrapper big active"><div class="spinner-layer spinner-blue-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div="circle"></div></div></div></div></div>

        <script>
        $(document).ready(function(){
            $('#table_display_data').tableExport();
            $('#table_display_data > caption >').hide();
            $('#table_display_data > caption >')[0].click();
            setTimeout(function(){
    console.log("THIS IS");
}, 4000);
           
        });
            
        </script>

    </body>
</html>
