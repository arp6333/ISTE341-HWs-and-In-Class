<html>
    <body>

        <?php
            // singleline comment
            /*
                multiline comment
            */
            $title = "Hello World";
        ?>

        <h1><?php echo "Hi World! - $title" ?></h1>

        <?php
            echo "<br />Name is ".$_GET['name']."<br />";
            $version = phpversion();
            echo "<h2>The version is: $version</h2>";

            // phpinfo();

            echo "<pre>";
            var_dump($_SERVER);
            echo "</pre>";
        ?>

    </body>
</html>