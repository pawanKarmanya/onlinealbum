<html>
    <head>
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/lightbox-2.6.min.js"></script>
        <link href="css/lightbox.css" rel="stylesheet" />    
    </head>
    <body>
        <?php
        $Location = $_SERVER['PHP_SELF'];
        $RowLength = 5;
        $base = "images";
        $Thumbs = "thumbs";
                if (isset($_GET['album'])) {
            $get_album = $_GET['album'];
        }
        if (!isset($get_album)) {
            echo '<b>Select an album</b><br>';
            $Directory = opendir($base);
            while (false !== ($file = readdir($Directory))) {
                if (is_dir($base . "/" . $file) && $file != "." && $file != ".." && $file != $Thumbs) {
                    echo "<a href='$Location?album=$file'>" . $file . "</a><br>";
                }
            }
            closedir($Directory);
        } else { 
            if (!is_dir($base . "/" . $get_album) || (strstr($get_album, ".") != null) || (strstr($get_album, "/") != null ) || (strstr($get_album, "\\") != null)) {
                echo 'Album does not exists';
            } else {
                echo "<b>" . $get_album . "</b><p />";
                $x = 0;
                $Directory = opendir($base . "/" . $get_album);
                while (($file = readdir($Directory)) != false) {
                    if ($file != "." && $file != "..") {
                        echo "<table style='display:inline;'><tr><td><a href='$base/$get_album/$file' data-lightbox='nondatabasealbum'><img src='$base/$Thumbs/$file' height='100' width='80'></a><td></tr></table>";
                        $x++;
                        if ($x == $RowLength) {
                            $x = 0;
                            echo '<br>';
                        }
                    }
                }

                closedir($Directory);
            }
        }
        echo "<p><a href='$Location'>Show Albums";
        ?>
    </body>

</html>