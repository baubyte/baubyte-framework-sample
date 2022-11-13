<h1>Home</h1>

<?php
foreach (["Mensaje 1", "Mensaje 2", "Mensaje 3"] as $message):
?>
    <p><?= $message; ?></p>
<?php
endforeach;
?>