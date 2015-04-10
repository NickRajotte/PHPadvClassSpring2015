<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        
        
        class MyClass {
            
            public function test() {
                echo 'this is a test';
            }
            
        }

        $classname = 'MyClass';
        $funcname = 'test';
        $obj = new $classname();
        
        
        $obj->$funcname();
        

        ?>
    </body>
</html>
