<?php foreach ($tasks as $key => $value):?>
    <a href="../../tasks/single/?id=<?=$value->id?>">
        <div class="catalog-preview" style="border: 1px #000 solid; margin: 5px; padding:5px; width: 150px">
            <div>Number: <?=$value->number?></div>
            <div><?=$value->name?></div>
        </div>
    </a>
<?php endforeach;?>