<?php $this->layout("layout", ["title" => "Products"]) ?>

<h1>List of Products</h1>

<a href="/product/new">New Product</a>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Size</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td>
                    <a href="/product/<?= $product->getId() ?>">
                        <?= $this->e($product->getName()) ?>
                    </a>
                </td>
                <td><?= $this->e($product->getDescription()) ?></td>
                <td><?= $product->getSize() ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
