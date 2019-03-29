<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>Contacts</title>
    </head>
    <body style="margin-top: 50px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div><a href="./" class="btn btn-info"><< Back to list</a></div>
                    <br />
                    <table border="0" cellpadding="0" cellspacing="0"  class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><a href="?orderby=name">Name</a></th>
                                <th><a href="?orderby=phone">Phone</a></th>
                                <th><a href="?orderby=email">Email</a></th>
                                <th><a href="?orderby=address">Address</a></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <a href="index.php?op=show&id=<?php print $contact->id; ?>">
                                        <?php print htmlentities($contact->name); ?>
                                    </a>
                                </td>
                                <td><?php echo htmlentities($contact->phone); ?></td>
                                <td><?php echo htmlentities($contact->email); ?></td>
                                <td><?php echo htmlentities($contact->address); ?></td>
                                <td>
                                    <a href="index.php?op=update&id=<?php echo $contact->id; ?>"><i class="fa fa-edit"></i> Edit</a> | 
                                    <a href="index.php?op=delete&id=<?php echo $contact->id; ?>"><i class="fa fa-trash-o"></i> Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>
