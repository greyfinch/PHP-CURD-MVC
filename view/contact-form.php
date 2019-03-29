<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>
        <?php echo htmlentities($title) ?>
        </title>
    </head>
    <body style="margin-top: 50px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <?php
                    if ( $errors ) {
                        echo '<div class="alert alert-danger>';
                        foreach ( $errors as $field => $error ) {
                            echo htmlentities($error).'<br />';
                        }
                        echo '</div>';
                    }
                    ?>
                    <div class="card">
                    <div class="card-header">
                    <?php echo htmlentities($title) ?>
                    </div>
                        <div class="card-body">                            
                            <form method="POST" action="">
                                <div class="form-group">
                                <label for="name">Name:</label><br/>
                                <input type="text" class="form-control"  name="name" value="<?php echo htmlentities($name) ?>" required />
                                <br/>                        
                                </div>

                                <label for="phone">Phone:</label><br/>
                                <input type="text" class="form-control"  name="phone" value="<?php echo htmlentities($phone) ?>" required />
                                <br/>
                                <label for="email">Email:</label><br/>
                                <input type="text"  class="form-control" name="email" value="<?php echo htmlentities($email) ?>" required />
                                <br/>
                                <label for="address">Address:</label><br/>
                                <textarea name="address"  class="form-control" required><?php echo htmlentities($address) ?></textarea>
                                <br/>
                                <input type="hidden" name="form-submitted" value="1" />
                                <input type="hidden" name="contact-id" value="<?php echo htmlentities($id) ?>" />
                                <input type="submit" class="btn btn-primary" value="Submit" />
                            </form>
                        </div>
                    </div>                
                </div>
            </div>
        </div>

    </body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>

