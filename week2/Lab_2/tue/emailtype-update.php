<?php
namespace nrajotte\week2;
include './bootstrap.php';
?>
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

            if ( $util->isPostRequest() ) {
                /* intiate variables from user entry */
                $emailtypeId = filter_input(INPUT_GET, 'emailtypeid');
                $emailTypemodel->setEmailtypeid($emailtypeId);
                $emailtype = filter_input(INPUT_POST, 'emailtype');
                $emailTypemodel->setEmailtype($emailtype);
                $active = filter_input(INPUT_POST, 'active');
                $emailTypemodel->setActive($active);
                $emailTypeservice->saveForm();
                header('Location: emailtype-test.php');
            }else{
                $emailtypeId = filter_input(INPUT_GET, 'emailtypeid');
                $emailTypemodel=$emailTypeDAO->getById($emailtypeId);
                $emailtype=$emailTypemodel->getEmailtype();
                $active=$emailTypemodel->getActive();
                $emailtypeid=$emailModel->getEmailtypeid();
            }

        ?>
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <h3>Add email</h3>
                <a href="/PHPadvClassSpring2015/Lab2/tue/email-test.php">Add Email</a>
                <br /><br />
            </div>
            <form action="#" method="post">
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <label>Email Type:</label>
                        <input type="text" name="emailtype" class="form-control" value="<?php echo $emailtype; ?>" placeholder="" />
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
                        <input type="submit" value="Submit" class="form-control" />
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
