<?php
$id_res = FILTER_INPUT(INPUT_GET,"id");
?>
<a href="clients.php?id_res=<?= $id_res?>">Messages</a>
<a href="avisadmin.php?id_res=<?= $id_res?>">Avis</a>