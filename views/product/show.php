<?php $this->layout("layout", ["title" => "Product"]) ?>

<h1><?= $this->e($product->getName()) ?></h1>

<p><?= $this->e($product->getDescription()) ?></p>

<p><?= $product->getSize() ?></p>
