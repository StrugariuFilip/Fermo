<?php
   include "db.php";
   session_start();
   if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
   }
   if (isset($_POST['rating']) && isset($_POST['offer_id'])) {
       $rating = intval($_POST['rating']);
       $offer_id = intval($_POST['offer_id']);
       $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
   
       $query = "SELECT rating_total, rating_count, rating_users, user_ratings FROM oferte WHERE id = '$offer_id'";
       $result = mysqli_query($con2, $query);
   
       if (mysqli_num_rows($result) > 0) {
           $row = mysqli_fetch_assoc($result);
   
           $user_ratings = json_decode($row['user_ratings'], true);
           $rating_users = json_decode($row['rating_users'], true);
   
           if (!is_array($user_ratings)) {
               $user_ratings = [];
           }
           if (!is_array($rating_users)) {
               $rating_users = [];
           }
   
           if (in_array($username, $rating_users)) {
               echo "<script>alert('Ai dat deja rating pentru această ofertă.');</script>";
               echo "<script>window.location.href = 'oferteview.php?id=$offer_id';</script>";
               exit();
           }
   
           $user_ratings[$username] = $rating;
   
           $rating_users[] = $username;
   
           $rating_total = $row['rating_total'] + $rating;
           $rating_count = $row['rating_count'] + 1;
   
           $user_ratings_json = json_encode($user_ratings);
           $rating_users_json = json_encode($rating_users);
   
           $update_query = "UPDATE oferte SET 
                               rating_total = '$rating_total', 
                               rating_count = '$rating_count', 
                               rating_users = '$rating_users_json', 
                               user_ratings = '$user_ratings_json' 
                           WHERE id = '$offer_id'";
           $update_result = mysqli_query($con2, $update_query);
   
           if ($update_result) {
               $_SESSION['rated_offer_ids'][$offer_id] = true;
               echo "<script>alert('Rating-ul tău a fost înregistrat cu succes.');</script>";
               echo "<script>window.location.href = 'oferteview.php?id=$offer_id';</script>";
               exit();
           } else {
               echo "<script>alert('Eroare la actualizarea ofertei.');</script>";
           }
       } else {
           echo "<script>alert('Oferta nu a fost găsită.');</script>";
       }
   }
   ?>