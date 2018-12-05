<?php foreach ($projects as $key => $value):?>
    <a href="./project/project/?id=<?=$value->id?>">
        <div class="catalog-preview" style="border: 1px #000 solid; margin: 5px; padding:5px; width: 150px">
            <div><?=$value->name?></div>
            <div>Status: <?=$value->id_status?></div>
        </div>
    </a>
<?php endforeach;?>