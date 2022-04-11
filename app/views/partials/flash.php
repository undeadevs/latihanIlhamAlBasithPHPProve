<?php if(isset($locals['flash']['error'])): ?>
    <div class="flash-msg error">
        <?= $locals['flash']['error'] ?>
    </div>
<?php endif; ?>

<?php if(isset($locals['flash']['success'])): ?>
    <div class="flash-msg success">
        <?= $locals['flash']['success'] ?>
    </div>
<?php endif; ?>