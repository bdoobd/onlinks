<h2>Возникла ошибка <?= $code ?></h2>

<h3>Файл: <?= $file ?> на строке <?= $line ?></h3>
<h3>Сообщение: <?= $message ?></h3>
<h4>Stack trace:</h4>
<p><?= nl2br($trace) ?></p>