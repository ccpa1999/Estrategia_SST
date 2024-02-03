<?php foreach ($_POST['data'] as $key => $dato) : ?>
    <div class="row mb-3">
        <div class="col-md-12 d-flex justify-content-center">
            <a href="resources/views/formularios/<?php echo str_replace(' ', '_', strtolower($dato['cuestionario'])) ?>.html.php" class="btn btn-orange col-md-6 p-1">
                <b><?php echo $dato['cuestionario'] ?></b>
            </a>
        </div>
    </div>
<?php endforeach; ?>