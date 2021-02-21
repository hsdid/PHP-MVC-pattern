<div class="row">
    
    <h3> All <?php echo $user->getName()?> articles</h3>
    
    <div class="mt-4">
        <?php if ($articles) {?>
            <table class="table" id="products">
                <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">title</th>
                            <th scope="col">description</th>
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
                    <td><a href="/category?id=<?php echo $article->getCategoryId(); ?> "> <?php echo $article->getCategory()->getName() ?> </a> </td>
                    <td> <?php echo $article->getCreatedAt(); ?> </td>
                    
                    
                </tr>
                <?php } ?>
                
                </tbody> 
            </table>
        <?php } else {?>
            You dont have any product

        <?php } ?>
    </div>

</div>