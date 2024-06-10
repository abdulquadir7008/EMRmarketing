<?php 
  if ( mysqli_num_rows( $video_verify_sql ) == 0 ) {
	  
    $query = "insert into ad_view_income_list(user_id,video_id,income) values('$customeid','$video_id','100')";
    mysqli_query( $link, $query );

    $wallet_video_sql = mysqli_query( $link, "select * from ad_view_wallet WHERE user_id='$customeid'" );
    $list_wallet = mysqli_fetch_array( $wallet_video_sql );
    if ( $list_wallet[ 'user_id' ] == $customeid ) {
      $wallet_count = $list_wallet[ 'wallet' ] + 100;
      $video_watch_count = $list_wallet[ 'video_watch_count' ] + 1;
      $query = "update ad_view_wallet SET user_id='$customeid',wallet='$wallet_count',video_watch_count='$video_watch_count' WHERE user_id=$customeid";
      mysqli_query( $link, $query );
    } else {
      $query = "insert into ad_view_wallet(user_id,wallet,video_watch_count) values('$customeid','100','1')";
      mysqli_query( $link, $query );
    }

  }
?>