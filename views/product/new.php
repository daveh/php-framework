<?php $this->layout("layout", ["title" => "New Product"]) ?>

<h1>New Product</h1>

<form method="post">
    <div>
        <label for="name">Name</label>
        <input type="text" id="name" name="name">
    </div>
    <div>
        <label for="description">Description</label>
        <textarea id="description" name="description"></textarea>
    </div>
    <div>
        <label for="size">Size</label>
        <input type="number" id="size" name="size" min="0">
    </div>

    <button type="submit">Create Product</button>
</form>