<?php if ($model->hasValidationErrors()): ?>
    <?php foreach ($model->getValidationErrors() as $field => $errors): ?>
        <p>Please correct the following errors in order to pass validation:</p>
        <ul>
            <li><?= $field ?>:</li>
            <ol>
            <?php foreach ($errors as $errorMessage): ?>
                <li><?= $errorMessage ?></li>
            <?php endforeach; ?>
            </ol>
        </ul>
    <?php endforeach; ?>
<?php endif; ?>