<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <li class="dropdown messages-menu">
                    <a href="/site/index">
                        Home
                    </a>
                </li>
                <li class="dropdown messages-menu">
                    <a href="/admin-tasks">
                        Tasks
                    </a>
                </li>
                <li class="dropdown messages-menu">
                    <a href="/project">
                        Projects
                    </a>
                </li>

                <?php if (!Yii::$app->user->isGuest):?>

                   <?= $this->render(
                        'login.php',
                        ['directoryAsset' => $directoryAsset]
                    );
                   ?>
                <?php endif;?>

            </ul>
        </div>
    </nav>
</header>
