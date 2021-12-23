<?php include('./templates/header.php') ?>
<div class="container">
    <div class="row">
        <div class="alert alert-info alert-dismissible fade show" role="alert" id='notempty'>
            <strong>Info!</strong> Si el problema no está relacionado con el pedido, ID de pedido = 0
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
        </div>
        <div>
            <button type="button" class="btn btn-danger text-white border-0 py-2 px-3 mx-2" data-bs-toggle="modal"
                data-bs-target="#history"><span> HISTORY <i class="ti-arrow-right"></i></span></button>
        </div>
        <div class="container" id='empty'>
            <div class="row">
                <div class="col-lg-12">
                    <div class="">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th class="content_tableUserId" scope="col">UserId</th>
                                    <th class="content_tableUserId" scope="col">Email</th>
                                    <th class="content_tableUserId" scope="col">Celular</th>
                                    <th scope="col">Order Id</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                  $sql = "SELECT * FROM contact"; 
                  $result = mysqli_query($conn, $sql);
                  $count = 0;
                  while($row=mysqli_fetch_assoc($result)) {
                      $contactId = $row['contactId'];
                      $userId = $row['userId'];
                      $email = $row['email'];
                      $phoneNo = $row['phoneNo'];
                      $orderId = $row['orderId'];
                      $message = $row['message'];
                      $time = $row['time'];
                      $count++; ?>
                                <tr>
                                    <td class="fs-6 fw-bold"><?php echo $contactId ?></td>
                                    <td class="content_tableUserId fs-6 fw-bold"><?php echo $userId ?></td>
                                    <td class="content_tableUserId fs-6 fw-bold"><?php echo $email ?></td>
                                    <td class="content_tableUserId fs-6 fw-bold"><?php echo $phoneNo ?></td>
                                    <td class="fs-6 fw-bold"><?php echo $orderId ?></td>
                                    <td class="fs-6 fw-bold"><?php echo $message ?></td>
                                    <td class="text-center fs-6 fw-bold">
                                        <button class="btn btn-sm btn-primary" type="button" data-toggle="modal"
                                            data-target="#reply<?php echo $contactId ?>">Responder</button>
                                    </td>
                                </tr>
                                <?php  }
                  if($count==0) {
                    ?><script>
                                document.getElementById("notempty").innerHTML =
                                    '<div class="alert alert-info alert-dismissible fade show" role="alert" style="width:100%"> You have not recieve any message!	</div>';
                                document.getElementById("empty").innerHTML = '';
                                </script> <?php
                  }
              ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- history Modal -->
<div class="modal fade" id="history" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="history">Tus mensajes enviados</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="notReply">
                <table class="table-striped table-bordered col-md-12 text-center">
                    <thead >
                        <tr>
                            <th>Contact Id</th>
                            <th>Reply Message</th>
                            <th>datetime</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                    $sql = "SELECT * FROM `contactreply`"; 
                    $result = mysqli_query($conn, $sql);
                    $totalReply = 0;
                    while($row=mysqli_fetch_assoc($result)) {
                        $contactId = $row['contactId'];
                        $message = $row['message'];
                        $datetime = $row['datetime'];
                        $totalReply++;

                        echo '<tr>
                                <td>' .$contactId. '</td>
                                <td>' .$message. '</td>
                                <td>' .$datetime. '</td>
                              </tr>';
                    }    

                    if($totalReply==0) {
                      ?><script>
                        document.getElementById("notReply").innerHTML =
                            '<div class="alert alert-info alert-dismissible fade show" role="alert" style="width:100%"> ¡No has respondido ningún mensaje!	</div>';
                        </script> <?php
                    }   

                ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php 
        $contactsql = "SELECT * FROM `contact`";
        $contactResult = mysqli_query($conn, $contactsql);
        while($contactRow = mysqli_fetch_assoc($contactResult)){
            $contactId = $contactRow['contactId'];
            $Id = $contactRow['userId'];
    ?>

    <!-- Reply Modal -->
    <div 
    class="modal fade" id="reply<?php echo $contactId; ?>" tabindex="-1" aria-labelledby="reply<?php echo $contactId; ?>" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="reply<?php echo $contactId; ?>">Respuesta a (Contact Id: <?php echo $contactId; ?>)</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="fetch/_fetchContactManage.php" method="post">
                <div class="text-left my-2">
                    <b><label for="message">Mensaje: </label></b>
                    <textarea class="form-control" id="message" name="message" rows="2" required minlength="5"></textarea>
                </div>
                <input type="hidden" id="contactId" name="contactId" value="<?php echo $contactId; ?>">
                <input type="hidden" id="userId" name="userId" value="<?php echo $Id; ?>">
                <button type="submit" class="btn btn-success" name="contactReply">Respuesta</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <?php
        }
    ?>

<?php include('./templates/footer.php') ?>
