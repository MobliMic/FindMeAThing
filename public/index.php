<?php
require_once('../.core/core.class.php');
$pageSettings = [
    'views' => [
        'header' => [
            'pageName' => 'Home',
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

            <div class="col-md-3 btn-lg">

                <h2><span class="glyphicons fast_food"></span>
                    Food</h2>
            </div>

            <div class="col-md-3 btn-lg">

                <h2><span class="glyphicons car"></span>
                    Parking</h2>
            </div>

            <div class="col-md-3 btn-lg">

                <h2><span class="glyphicons stroller"></span>
                    Family Areas</h2>
            </div>

            <div class="col-md-3 btn-lg">

                <h2><span class="glyphicons cardio"></span>
                    Emergency Services</h2>
            </div>

        </div>


<?php
// Render Footer
$thisPage->renderView('footer');
?>