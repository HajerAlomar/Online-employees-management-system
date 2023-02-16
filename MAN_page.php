<?php
if (!isset($_SESSION)) {
    session_start();
}
include "DB.php";
$manID = $_GET['id'];
$_SESSION['id'] = $manID;
$sql_MAN = "SELECT * from Manager where id = '" . $manID . "'";
$query_MAN = mysqli_query($connection, $sql_MAN);
$MAN = mysqli_fetch_assoc($query_MAN);
$_SESSION['man_name'] = $MAN['first_name'] . ' ' . $MAN['last_name'];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Maneger page</title>
        <link rel="stylesheet" href="StyleSheet.css ">
        <script src="javaScript.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            function Update_State(id, state, man_id) {
                $.ajax({
                    url: "UpdateStatus.php?request_id=" + id + "&state=" + state + "&man_id=" + man_id,
                    dataType: 'text',

                    success: function (response) {
                        console.log(response);
                        $("#td" + id).html(response);
                        $("#td2" + id).html(state);
                        location.reload();
                    }
                })


            }


            function Dscrp(id) {

                $.ajax({

                    url: "Dscrp.php",
                    method: "POST",
                    data: {id: id},
                    dataType: 'json',

                    success: function (response) {

                        console.log(response);
                        $("#" + id).attr("title", "Description: " +response);

                    }
                })


            }


        </script>
    </head>

    <body>
        <header>
            <nav>
                <ul class="navb">
                    <li><a href="aboutUS.html"accesskey="a">About us</a></li>
                    <li><a href="help.html"accesskey="q">Help</a> </li>
                    <div class="logOut"><a href="logout.php"  > <img src="img/logOut.png" alt="log out" width="40" height="40"></a></div>

                </ul>
            </nav>
        </header>


        <main>
            <a href="MAN_page.php?id=<?php echo $_SESSION['id'] ?> "><img src="img/HRMS.png" alt="logo" width="270" height="100"></a><br>
            <h1>HRMS Company</h1>

            <h2>Welcome <?php echo $_SESSION['man_name']; ?></h2>
            <div class="add">
                <table class="T1">
                    <?php
                    $q = "SELECT * FROM service";
                    $r = mysqli_query($connection, $q);
                    while ($row = mysqli_fetch_array($r)) {
                        ?>

                        <tr>
                            <th class="z0" colspan="3"><?php echo $row['type'] ?></th>
                        </tr>

                        <?php
                        $id = $row['id']; // service id 
                        $q1 = "SELECT * FROM request where service_id=$id ORDER BY status desc";
                        $r1 = mysqli_query($connection, $q1);
                        $c1 = mysqli_num_rows($r1);
                        if ($c1 <> 0) {
                            ?>
                            <tr  class="r2">
                                <td >Request</td>
                                <td colspan="2" >Status</td>
                            </tr>

                            <?php
                            while ($row1 = mysqli_fetch_array($r1)) {
                                ?>
                                <tr id="<?php echo $row1['id']; ?>" onmouseover="Dscrp('<?php echo $row1['id']; ?>')" data-toggle="tooltip"
                                    title=""
                                    <?php if ($row1['status'] == 'in_progress') echo " bgcolor='#65bf59' >"; ?> >

                                    <td class="p2">
                                        <a href="reqinfo.php?request_id=<?php echo $row1['id'] ?>&role=manager&man_id=<?php echo $manID ?>">
                                            <b><?php
                                                echo $row1['id'] . " - ";
                                                $emp_id = $row1['emp_id'];
                                                $q2 = "SELECT * FROM Employee where id='$emp_id'";
                                                $r2 = mysqli_query($connection, $q2);
                                                $row2 = mysqli_fetch_array($r2);
                                                $emp_name = $row2['first_name'] . " " . $row2['last_name'];
                                                echo($emp_name);
                                                ?></b>
                                        </a>
                                    </td>
                                    <td class="a1">
                                        <?php
                                        if ($row1['status'] == "in_progress") {
                                            echo 'In progress';
                                        } else if ($row1['status'] == 'Approve') {
                                            echo 'Approved';
                                        } elseif ($row1['status'] == 'Decline') {
                                            echo 'Declined';
                                        }
                                        ?>
                                    </td>
                                    <td class="t5">
                                        <?php if ($row1['status'] == 'in_progress' || $row1['status'] == 'Approve') { ?> 
                                            <button id="btn" onclick="Update_State(<?php echo $row1['id']; ?>, 'Decline', <?php echo $manID ?>)">Decline</button>

                                        <?php } if ($row1['status'] == 'in_progress' || $row1['status'] == 'Decline') { ?>

                                            <button id="btn" onclick="Update_State(<?php echo $row1['id']; ?>, 'Approve',<?php echo $manID ?>)">Approve</button> 
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>

                        <?php
                    }
                    ?>
            </div>
        </div>

    </main>


    <footer>
        <img src="img/twitter.png" alt="Twitter" width="30" height="30" onclick="twitter()">
        <img src="img/email.png" alt="Email" width="30" height="30" onclick="email()">
        <img src="img/call.png" alt="phoneNumber" width="30" height="30" onclick="phone()">
        <aside><P>&copy;2021 KSU</P></aside>
    </footer>
</body>
</html>
