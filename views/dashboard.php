
<div class="row">
   
    
</div>

<div class="row mt-4">
    
    <h3>Dashboard with your articles</h3>


    <div class="mt-4">
        <select class="form-select" aria-label="Default select example" onchange="location = this.value;">
            <option selected>Choose category</option>
            <option  value="/dashboard" >All categories</option>
            <?php foreach ($categories as $category ){  ?>
                
                <option value="/dashboard/category?categoryId=<?php echo $category->getId() ?>"> 
                    
                        <?php echo $category->getName(); ?>
                   
                </option>
            
            <?php }?>
        </select>
    </div>

    <div class="column mt-4">
    <a href="/article" class="btn btn-primary">Add Arrticle</a>
    </div>

    <div class="mt-4">
        <?php if ($articles) {?>
            <table class="table" id="products">
                <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">title</th>
                            <th scope="col">description</th>
                            <th scope="col">status</th>
                            <th scope="col">category</th>
                            <th scope="col">created at</th>
                            
                        </tr>
                       
                </thead>
                <tbody>
                
                <?php foreach ($articles as $article ){  ?>
                
                <tr>
                    
                    <td scope="row"> <?php echo $article->getId(); ?> </td>
                    <td> <?php echo $article->getTitle(); ?> </td>
                    <td> <?php echo $article->getDescription(); ?> </td>
                    <td>
                    <select name="" id="" class="" onchange="location = this.value;">
                       
                        <?php if ( $article->getPublicStatus()) {?>
                            <option selected value="/article/status?articleId=<?php echo $article->getId();?>&status=1">
                                public
                            </option>
                            <option value="/article/status?articleId=<?php echo $article->getId();?>&status=0">
                                private
                            </option>
                        <?php } else  {?>

                            <option selected value="/article/status?articleId=<?php echo $article->getId();?>&status=0">
                                private
                            </option>
                            <option value="/article/status?articleId=<?php echo $article->getId();?>&status=1">
                                public
                            </option>
                            
                        <?php } ?>
                    </select>
                    </td>
                    
                    <td><a href="/article/category?categoryId=<?php echo $article->getCategoryId(); ?> "> <?php echo $article->getCategory()->getName() ?> </a> </td>
                    <td> <?php echo $article->getCreatedAt(); ?> </td>
                    
                    
                    <td>
                        <a href="/article/edit?articleId=<?php echo $article->getId();?> " class="btn btn-light">Edit</a>
                        <a href="/article/remove?articleId=<?php echo $article->getId();?>" class="btn btn-danger delete-product">Delete</a>
                    </td> 
                   
                </tr>
                <?php } ?>
                
                </tbody> 
            </table>
        <?php } else {?>
            You dont have any article in this category, go add (<a href="/article"> here</a>)

        <?php } ?>
    </div>

</div>