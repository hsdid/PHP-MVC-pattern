
<?php

use app\core\Application;
?>
<h3>Create Article</h3>

<?php if (Application::$app->session->getFlash('error_article')){ ?>
    <div class="alert alert-danger">
    <?php echo print_r(Application::$app->session->getFlash('error_article')); ?>
    </div>
<?php }?>
<form method="post" class="mt-4">
    
    <label for="title">Title</label>
    <input type="text" name="title" id="inputName" class="form-control" required autofocus>

    
    <label for="description">Description</label>
    <textarea type="text" name="description" id="description" class="form-control" required>
    </textarea>
    

    <label for="category">category</label>
    <select name="categoryId" class="form-select" aria-label="Default select example" >

        <?php foreach ($categories as $category ){  ?>
            
            <option value="<?php echo $category->getId() ?>">
                <?php echo $category->getName(); ?>
            </option>
            
        <?php }?>
    </select>


   <button class="btn btn-lg btn-primary mt-2" type="submit">
        add product
    </button>


</form>