<?php
session_start();
include "controllers/database_functions.php";
include "controllers/basic_functions.php";
include "database/config.php";
include "controllers/check_login.php";                                                                                                                                                              

$get_id=$_GET['id'];
$get_checker=$_GET['checker'];
$get_item = $_GET['item'];
$get_from = $_GET['from'];
$get_to = $_GET['to'];
$stat = 'Approve';


if($get_checker == "1"){

    if(countResult ($conn, "SELECT * from bookings_tb where inventory_item_id='$get_item' and (date_from_requested BETWEEN '$get_from' and '$get_to' or date_to_requested BETWEEN '$get_from' and '$get_to') and status='$stat'") == 1){
        updateDatabase($conn, "UPDATE bookings_tb set status = 'Disapprove' where inventory_item_id = '$get_item' and date_from_requested = '$get_from' and date_to_requested = '$get_to' and status = 'Pending'");
        redirectPageWithAlert("reservations_admin.php", "There is already approved reservation for that. The reservation was disapproved");
    }else{
        if(countResult($conn, "SELECT * from bookings_tb where date_from_requested = '$get_from' or date_to_requested = '$get_to' and inventory_item_id = '$get_item' and status = 'Pending'") == 1) {
            if(updateDatabase($conn, "UPDATE bookings_tb set status = 'Approve' where booking_id ='$get_id'") == 1){
                updateDatabase($conn, "UPDATE bookings_tb set status='Disapprove' where inventory_item_id = '$get_item' and date_from_requested='$get_from' and date_to_requested='$get_to' and status='Pending'");
                redirectPageWithAlert("reservations_admin.php", "Reservation is now Approved");
            }else{  
                redirectPageWithAlert("reservations_admin.php", "Error. Please Try Again");
            }
        }else{
            if(updateDatabase($conn, "UPDATE bookings_tb set status = 'Approve' where booking_id ='$get_id'") == 1){
                redirectPageWithAlert("reservations_admin.php", "Reservation is now Approved");
            }else{  
                redirectPageWithAlert("reservations_admin.php", "Error. Please Try Again");
            }
        }
    }

}else{
    if(updateDatabase($conn, "UPDATE bookings_tb set status = 'Disapprove' where booking_id ='$get_id'") == 1){
        redirectPageWithAlert("reservations_admin.php", "Reservation is now Approved");
    }else{  
        redirectPageWithAlert("reservations_admin.php", "Error. Please Try Again");
    }
}

?>

