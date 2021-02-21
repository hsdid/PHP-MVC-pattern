<div class="row">
    
    <div class="mt-4">
        <select class="form-select" aria-label="Default select example" onchange="location = this.value;">
            <option selected>Choose category</option>
            <option value="/">All categories</option>
            <?php foreach ($categories as $category ){  ?>
                
                <option value="/article/category?categoryId=<?php echo $category->getId() ?>"> 
                    
                        <?php echo $category->getName(); ?>
                   
                </option>
            
            <?php }?>
        </select>
    </div>
                
   

    <div class="mt-4">
        <?php if ($articles) {?>

            <div >
                found (<?php echo count($articles); ?>) articles 
            </div>

            <table class="table" id="products">
                <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">title</th>
                            <th scope="col">description</th>
                            <th scope="col">user</th>

                            <th scope="col">created at</th>
                            
                        </tr>
                       
                </thead>
                <tbody>
                
                <?php foreach ($articles as $article ){  ?>
                
                <tr>
                    
                    <td scope="row"> <?php echo $article->getId(); ?> </td>
                    <td> <?php echo $article->getTitle(); ?> </td>
                    <td > <?php echo $article->getDescription(); ?> </td>
                    <td>
                        <a href="/user?id=<?php echo $article->getUser()->getId();?> ">
                            <?php echo $article->getUser()->getName(); ?>  
                        </a> 
                    </td>
                    <td> <?php echo $article->getCreatedAt(); ?> </td>
                    
                   
                </tr>
                <?php } ?>
                
                </tbody> 
            </table>
        <?php } else {?>
            <h5 class=" text-center mt-4">
            articles not found, You can create firrst article in this category go (<a href="/article"> here</a>)
            </h5>
            
        <?php } ?>
    </div>

</div>