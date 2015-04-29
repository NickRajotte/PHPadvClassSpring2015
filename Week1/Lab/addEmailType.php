<?php include './bootstrap.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            $emailTypeService = new emailTypeDB();
            $emailType = filter_input(INPUT_POST, 'emailtype');
            $emailTypeService->Save($emailType);
        ?>
         <h3>Add Email type</h3>
        <form action="#" method="post">
            <label>Email Type:</label> 
            <input type="text" name="emailtype" value="<?php echo $emailType; ?>" placeholder="" />
            <input type="submit" value="Submit" />
        </form>
        <?php 
            $emailTypeService->displayEmails();
        ?>  
    </body>
</html>