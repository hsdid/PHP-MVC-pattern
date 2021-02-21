
<h3>Edit Article</h3>

<form method="post">
    
    <label for="name">Title</label>
    <input type="text" name="title" id="inputName" class="form-control" value="<?php echo $article->getTitle(); ?>" required autofocus>

    <label for="info">Description</label>
    <input type="textarea" name="description" id="description" class="form-control" value="<?php echo $article->getDescription(); ?>" required>
    
    <label for="info">category</label>
    <select name="categoryId" class="form-select" aria-label="Default select example">
    
        <option selected value="<?php echo $article->getCategory()->getId(); ?>">
            <?php echo $article->getCategory()->getName(); ?>
        </option>
        
        <?php foreach ($categories as $category ){  ?>
            
            <option value="<?php echo $category->getId() ?>">
                <?php echo $category->getName(); ?>
            </option>
            
        <?php }?>
    </select>
    
    
   <button class="btn btn-lg btn-primary mt-4" type="submit">
        edit product
    </button>
</form>