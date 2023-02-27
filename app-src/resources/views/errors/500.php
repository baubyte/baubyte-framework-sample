<?php if (env("APP_ENV") == "dev"): ?>
<pre>
<?= $e->getMessage() ?>
<br>
<?= $e->getTraceAsString() ?>
</pre>
<?php else: ?>
HTTP 500 INTERNAL SERVER ERROR
<?php endif; ?>
