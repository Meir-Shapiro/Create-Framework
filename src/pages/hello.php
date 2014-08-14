<?php

$input = $request->get('name', 'World!');
?>
Hello there <?=  htmlspecialchars($input, ENT_QUOTES, 'UTF-8') ?>
