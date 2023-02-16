<?php
include_once('DB.php');
if (!isset($_SESSION)) {
    session_start();
}
$_SESSION['request_id'] = $reqID = $_GET['request_id'];
$reqID = $_GET['request_id'];
$role = $_GET['role'];
$_SESSION['role'] = $role;

$sql = "SELECT `emp_id` FROM `request` where id=" . $reqID;
$emp = mysqli_query($connection, $sql);
$empRES = mysqli_fetch_assoc($emp);
$emp_id = $empRES['emp_id'];
?>


<!DOCTYPE html>
<html>
    <head>
        <title> Request information page</title>
        <link rel="stylesheet" href="StyleSheet.css ">
        <script src="javaScript.js"></script>

    </head>
    <body  action="reqinfo.php" method="POST">
        <header>
            <nav>
                <ul class="navb">
                    <?php
                    // customize navigation bar based on user role
                    if ($_SESSION['role'] == 'Employee') {
                        echo '<li><a href="EMP_page.php?emp_id=' . $emp_id . '" accesskey="h"> Employee Home </a></li>';
                    } else
                    if ($_SESSION['role'] == 'manager') {
                        $manID = $_GET['man_id'];
                        echo '<li><a href="MAN_page.php?&id=' . $manID . '" accesskey="h"> Manager Home </a></li>';
                    }
                    ?>

                    <li><a href="aboutUS.html"accesskey="a">About us</a></li>
                    <li><a href="help.html"accesskey="q">Help</a> </li>
                    <div class="logOut"><a href="logout.php"> <img src="img/logOut.png" alt="log out" width="40" height="40"></a></div>
                </ul>
            </nav>
            <ul class="breadcrumbs">
                <li></><a href="logout.php">Home</a></li>
                <?php
                // customize navigation bar based on user role
                if ($_SESSION['role'] == 'Employee') {
                    echo '<li><a href="EMP_page.php?emp_id=' . $emp_id . '" accesskey="h"> Employee Home </a></li>';
                } else
                if ($_SESSION['role'] == 'manager') {
                    $manID = $_GET['man_id'];
                    echo '<li><a href="MAN_page.php?&id=' . $manID . '" accesskey="h"> Manager Home </a></li>';
                }
                ?>
                <li><span>Request information</span></li>
            </ul>

        </header>
        <main>
            <a href="index.php"><img src="img/HRMS.png" alt="logo" width="270" height="100"></a><br>
            <h1>HRMS Company</h1>
            <div class="formInfo2">
                <fieldset>
                    <div class="reqinf">
                        <span> <h3 id="sertyp">

                                <?php
                                // select by service id not request id
                                $serid = "SELECT `service_id` FROM `request` WHERE `id`=$reqID";
                                $serid = mysqli_query($connection, $serid);
                                $serid = mysqli_fetch_assoc($serid);
                                $serid = $serid['service_id'];

                                $ReqType = "SELECT type FROM `service` where id=$serid";
                                $ReqTypeRES = mysqli_query($connection, $ReqType);
                                $ReqTypeRESULT = mysqli_fetch_assoc($ReqTypeRES);
                                echo $ReqTypeRESULT['type'];
                                ?></h3></span>
                        <span> <h3 id="serstat">

                                <?php
                                $ReqSTAT = "SELECT * FROM `request` where id=" . $reqID;
                                $ReqSTATres = mysqli_query($connection, $ReqSTAT);
                                $ReqSTATresult = mysqli_fetch_assoc($ReqSTATres);
                                $ReqSTAT = $ReqSTATresult['status'];

                                echo $ReqSTAT;
                                ?></h3></span>
                    </div>

                    <h3 id="empnam">
                        <?php
                        $empName = "SELECT first_name,last_name FROM `Employee` where id=" . $emp_id;
                        $empNameRES = mysqli_query($connection, $empName);
                        $empNameRESULT = mysqli_fetch_assoc($empNameRES);
                        echo '[';
                        foreach ($empNameRESULT as $value)
                            echo $value . " ";
                        echo ']';
                        ?>
                    </h3>

                    <p>
                        <?php
                        $ReqID = "SELECT id FROM request where emp_id='$emp_id'";
                        $ReqIDres = mysqli_query($connection, $ReqID);
                        $ReqIDresult = mysqli_fetch_array($ReqIDres);

                        if ($_SESSION['role'] == 'Employee')
                            echo "<a href=\"edit.php?request_id=" . $reqID . "\">Edit</a>";

                        if ($_SESSION['role'] == 'manager') {
                            if ($ReqSTAT == 'Approve')
                                echo '<a href="UpdateStatus.php?request_id=' . $reqID . '&state=Decline&man_id=' . $_SESSION['man_id'] . '";>Decline</a>';
                            else
                            if ($ReqSTAT == 'Decline')
                                echo '<a href="UpdateStatus.php?request_id=' . $reqID . '&state=Approve&man_id=' . $_SESSION['man_id'] . '";>Approve</a>';

                            else
                            if ($ReqSTAT == 'in_progress') {
                                echo '<a href="UpdateStatus.php?request_id=' . $reqID . '&state=Decline&man_id=' . $_SESSION['man_id'] . '";> Decline | </a>';
                                echo '<a href="UpdateStatus.php?request_id=' . $reqID . '&state=Approve&man_id=' . $_SESSION['man_id'] . '";>Approve</a>';
                            }
                        } //end manager role
                        ?>
                    </p>
                    <p id="reqDesc"> 
                        <?php
                        $ReqDESC = "SELECT description FROM `request` where id=" . $reqID;
                        $ReqDescRES = mysqli_query($connection, $ReqDESC);
                        $ReqDescRESULT = mysqli_fetch_assoc($ReqDescRES);
                        echo "Request Description: " . $ReqDescRESULT['description'];
                        ?></p>

                    <h3>Attachments:</h3><div id="reqfile1">
                        <?php
                        $ReqAttach1 = "SELECT attachment1 FROM `request` WHERE id=" . $reqID;
                        $ReqAttachRes1 = mysqli_query($connection, $ReqAttach1);
                        $ReqAttachResult1 = mysqli_fetch_assoc($ReqAttachRes1);

                        foreach ($ReqAttachResult1 as $result1)
                            ;
                        $fileType1 = pathinfo($result1, PATHINFO_EXTENSION);
                        if ($fileType1 == 'pdf')
                            echo '<a href="' . $result1 . '">' . $result1 . '</a>';
                        else
                            echo '<img src="' . $result1 . '">';
                        ?></div>
                    <hr>
                    <div id="reqfile2">
                        <?php
                        $ReqAttach2 = "SELECT attachment2 FROM `request` WHERE id=" . $reqID;
                        $ReqAttachRes2 = mysqli_query($connection, $ReqAttach2);
                        $ReqAttachResult2 = mysqli_fetch_assoc($ReqAttachRes2);

                        foreach ($ReqAttachResult2 as $result2)
                            ;
                        $fileType2 = pathinfo($result2, PATHINFO_EXTENSION);
                        if ($fileType2 == 'pdf')
                            echo '<a href="' . $result2 . '">' . $result2 . '</a>';
                        else
                            echo '<img src="' . $result2 . '">';
                        ?></div>
                </fieldset></div>
        </main>

        <footer>
            <img src="img/twitter.png" alt="Twitter" width="30" height="30" onclick="twitter()">
            <img src="img/email.png" alt="Email" width="30" height="30" onclick="email()">
            <img src="img/call.png" alt="phoneNumber" width="30" height="30" onclick="phone()">
            <aside><P>&copy;2021 KSU</P></aside>
        </footer>
    </body>
</html>


