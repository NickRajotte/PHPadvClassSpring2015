<?php
namespace nrajotte\week2;
include './bootstrap.php'; ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="/PHPadvClassSpring2015/Lab2/tue/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="/PHPadvClassSpring2015/Lab2/tue/css/stylesheet.css" type="text/css">
        <link rel="script" href="/css/bootstrap.min.js" type="text/css">
    </head>
    <body>
        <?php
            $dbConfig=  array(
                "DB_DNS"=> 'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
                "DB_USER"=>'root',
                "DB_PASSWORD"=>''
            );

            $dbPdo = new DB($dbConfig);
            $util = new Util();
            $validator = new Validator();
            $emailDAO= new EmailDAO($dbPdo->db());
            $emailModel = new EmailModel();
            $emailTypeDAO = new EmailTypeDAO($dbPdo->db());
            $emailTypemodel = new EmailTypeModel();
            $emailService = new EmailService($dbPdo->db(), $util, $validator, $emailDAO, $emailModel);
            $emailTypeservice = new EmailTypeService($dbPdo->db(), $util, $validator, $emailTypeDAO, $emailTypemodel);

            /* if there is an id it is from the delete */
            $emailid = filter_input(INPUT_GET, 'emailid');
            if(!empty($emailid)){
                $emailService->ifIdexistDelte($emailid);
            }
            /* intiate variables from user entry */
            $email = filter_input(INPUT_POST, 'email');
            $emailModel->setEmail($email);
            $emailTypeid = filter_input(INPUT_POST, 'emailtypeid');
            $emailModel->setEmailtypeid($emailTypeid);
            $active = filter_input(INPUT_POST, 'active');
            $emailModel->setActive($active);
            $emailService->saveForm();

            /* get all email type rows */
            $email = "";
            $emailtypeid = "";
            $active="";
        ?>
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <h3>Add email</h3>
                <a href="/PHPadvClassSpring2015/week2/Lab_2/tue/emailtype-test.php" class="btn btn-default">Add EmailType</a>
                   <br /><br />
            </div>
            <form action="#" method="post">
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <label>Email:</label>
                        <input type="text" class="form-control" name="email" value="<?php echo $email; ?>" placeholder="" />
                        <br /><br />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <label>Active:</label>
                        <input type="number" class="form-control" max="1" min="0" name="active" value="<?php echo $active; ?>" />
                        <br /><br />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <label>Email Type:</label>
                        <select name="emailtypeid" class="form-control">
                        <?php
                            $emailTypes = $emailTypeDAO->getAllRows();
                            $emailTypeservice->displayEmailtypeSelect($emailTypes,$emailModel->getEmailtypeid());
                        ?>
                        </select>
                         <br /><br />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <input type="submit" value="Submit" class="form-control" />
                    </div>
                </div>
            </form>
            <?php
                $emailService->displayEmailsActions();
            ?>
        </div>
    </body>
</html>
