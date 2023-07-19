<p>&copy; PHP Motors, All rights reserved.</p>
<p>Images are believed to be "Fair Use". Notify if any are not and they will be removed.</p>
<p>Last Updated: 
    <?php 
    $file = $_SERVER["SCRIPT_NAME"];
    $break = Explode('/', $file);
    $pfile = $break[count($break) - 1];
    echo date("d F , Y", fileatime($pfile))
    ?>
</p>