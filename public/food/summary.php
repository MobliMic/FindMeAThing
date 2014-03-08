<?php
require_once('../../.core/core.class.php');
$pageSettings = [
    'views' => [
        'header' => [
            'pageName' => 'Food - Restaurant',
            'sass' => ['main' => true],
            'js' => ['main' => true]
        ],
        'body' => true,
        'footer' => true
    ],
    'forms' => true
];
$thisPage = new HC_Page($pageSettings);

// Render Header
$thisPage->renderView('header');
?>


    <div class="row">

        <dl">
            <dt>Name</dt>
            <dd><?php echo $_GET['name']; ?></dd>

            <dt>Name</dt>
            <dd>Description</dd>

            <dt>Name</dt>
            <dd>Description</dd>


        </dl>

    </div>


<?php
// Render Footer
$thisPage->renderView('footer');
?>